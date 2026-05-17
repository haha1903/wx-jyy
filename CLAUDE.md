# wx-jyy — 谛佳扬官网

无锡谛佳扬科技有限公司（DJY）官网。WordPress 站，跑在 AKS 上，git push 自动部署。

- 前台：https://wx-jyy.changhai.me/  （等 wx-jyy.com transfer 完会再加上）
- 后台：https://wx-jyy.changhai.me/wp-admin/

---

## 仓库结构

```
wx-jyy/
├── manifests/                    # K8s 部署配置（applied via GitHub Actions）
│   ├── namespace.yml             # ns: wx-jyy
│   ├── pvc.yml                   # 2 个 Azure Disk PVC: db (4Gi) + uploads (4Gi)
│   ├── mariadb.yml               # MariaDB 11 deployment + service
│   ├── deployment.yml            # WordPress 6 + PHP 8.3 + Apache (image: wordpress:6-php8.3-apache)
│   ├── service.yml               # ClusterIP for nginx ingress
│   └── ingress.yml               # 路由 wx-jyy.changhai.me / wx-jyy.com / www.wx-jyy.com
│
├── theme/wx-djy/                 # WordPress 主题 — 唯一会被 CI 同步进 pod 的代码
│   ├── style.css                 # 全部前台 CSS（HP 风格白底蓝字）+ 主题元信息
│   ├── functions.php             # 入口：require inc/*，注册脚本/样式，多语言 helper
│   ├── header.php / footer.php   # 站头站尾
│   ├── front-page.php            # 转发到 templates/home.php
│   ├── page.php / index.php      # fallback
│   ├── inc/
│   │   ├── cpt.php               # 注册 CPT (news/product/equipment/biz_card/factory_photo/cert/service/principle)
│   │   └── acf-fields.php        # ACF 字段组定义（PHP API，不用在 wp-admin 手动建）
│   ├── templates/
│   │   ├── home.php              # 首页（hero / 资质 / 业务卡 / 品质宣言 / 工厂 / 新闻 / 联系条）
│   │   ├── jieshao.php           # 关于
│   │   ├── chanpin.php           # 产品
│   │   ├── shebei.php            # 设备
│   │   └── lianxi.php            # 联系
│   ├── image/                    # 兜底素材（首次 seed 用，迁移后媒体库才是权威）
│   ├── js/gundong.js             # 老 banner 滚动脚本（已不用，留着以防）
│   └── image/logo.svg            # 蓝色品牌 logo
│
└── .github/workflows/deploy.yml  # CI: build → push → kubectl apply → sync theme into pod
```

**注意**：不存在 Dockerfile 或 docker-compose（早期有，已删）。WP 镜像直接用官方 `wordpress:6-php8.3-apache`，theme 通过 `kubectl exec ... tar` 注入到 pod 的 `/var/www/html/wp-content/themes/wx-djy/`。

---

## 基础设施

| 资源 | 位置 | 备注 |
|------|------|------|
| AKS 集群 | `haiaks` (rg `hai`, australiaeast) | 个人订阅 `edd2190c-...` (changhai@me.com) |
| K8s namespace | `wx-jyy` | 跟 cnc-mes / wiki 共集群 |
| 数据库 | MariaDB pod (ns 内) | PVC `wx-jyy-db` 4Gi Azure Disk |
| 媒体库 + WP 文件 | `/var/www/html` | PVC `wx-jyy-uploads` 4Gi Azure Disk（含 plugins/themes/uploads/wp-config） |
| 入口 | Cloudflare Tunnel `haiaks-cnc` → ingress-nginx → service | 共用集群 tunnel，配置在 `cloudflare/cloudflared-config` ConfigMap |
| 镜像 registry | ghcr.io/haha1903/wx-jyy:latest | （早期建的，但现在用官方 WP 镜像，自定义镜像未必再 build） |

**域名状态**：
- `wx-jyy.changhai.me` ✅ 工作中（cloudflared route + Cloudflare Universal SSL）
- `wx-jyy.com` / `www.wx-jyy.com` — DNS host 转移到 Cloudflare 进行中。Ingress 已配，等 zone Active 跑：
  ```
  cloudflared tunnel route dns 9f29f99c-7cb8-4f99-8af4-9bb5ecc7b617 wx-jyy.com
  cloudflared tunnel route dns 9f29f99c-7cb8-4f99-8af4-9bb5ecc7b617 www.wx-jyy.com
  ```

---

## 部署流程

```
你 → git push → GitHub master 分支
                    ↓
       GitHub Actions (.github/workflows/deploy.yml)
                    ↓
          azure/login@v2 (OIDC, 无 secret 凭据)
                    ↓
          az aks get-credentials -g hai -n haiaks
                    ↓
          kubectl apply -f manifests/
          kubectl rollout status (mariadb + wx-jyy)
                    ↓
          tar c theme/wx-djy | kubectl exec ... tar x
          chown -R www-data:www-data
```

**触发条件**：push 改了 `manifests/**` 或 `theme/**` 才部署。
**OIDC 配置**：AAD App `github-wx-jyy-deploy`，federated credential 绑定 `repo:haha1903/wx-jyy:ref:refs/heads/master`，授予 AKS Cluster User Role。
**GitHub repo Variables**（不是 Secrets）：
- `AZURE_CLIENT_ID` = `ed8d0abd-fa26-4b08-9a9f-0768e28c68f0`
- `AZURE_TENANT_ID` = `aed1e1bc-3373-46e6-a63a-9aa4132ce2e1`
- `AZURE_SUBSCRIPTION_ID` = `edd2190c-ed8c-40d9-8d63-796efea73dde`

---

## 内容架构（CMS 模型）

90% 内容都是 WordPress 数据库里的东西，只有 **页面骨架** 在 PHP 里。

### 页面（Page，5 个）
每个 page 只是个"占位"，绑定一个 template + ACF 字段。

| 前台 URL | 后台 Page slug | template | 数据存哪 |
|---------|---------------|----------|---------|
| `/` | home (id=99) | `home.php` | ACF 字段（hero/品质/联系）+ CPT 查询 |
| `/jieshao/` | jieshao (id=100) | `jieshao.php` | ACF 字段（介绍/合作）+ CPT 查询 |
| `/chanpin/` | chanpin (id=101) | `chanpin.php` | 产品 CPT + product_cat taxonomy |
| `/shebei/` | shebei (id=102) | `shebei.php` | 设备 CPT + equipment_section taxonomy |
| `/lianxi/` | lianxi (id=49) | `lianxi.php` | 全部读首页 ACF（公司概要/联系方式） |

### 自定义文章类型（CPT，8 个）

| CPT | 用途 | 字段 |
|-----|------|------|
| `news` | 公司新闻 | 标题 + 中日日期 + 中日正文（双语 textarea） |
| `product` | 产品 | 标题 + 缩略图 + 日语标题 + product_cat 分类 |
| `equipment` | 设备 | 标题 + 缩略图 + 日语标题 + equipment_section 分组 |
| `biz_card` | 首页业务卡片（关于/产品/设备 3 张） | 标题 + 缩略图 + 日语标题 + 中日描述 + 跳转 URL |
| `factory_photo` | 首页工厂实景（3 张） | 标题(=中文 caption) + 缩略图 + 日语 caption |
| `cert` | 首页 ISO 资质（2 张） | 标题（仅后台辨识） + 缩略图 |
| `service` | 关于页"服务领域"（5 行） | 标题 + 日语翻译 |
| `principle` | 关于页"经营方针"（3 行） | 标题 + 日语翻译 |

### Taxonomies（2 个）

- `product_cat`（产品分类）：medical / detection / semiconductor / general / more
- `equipment_section`（设备分组）：main / center / process

每个 term 可以挂 `name_jp` term meta 存日语名（templates 里读）。

### 双语系统

不用 Polylang。用一对 `xxx_zh` + `xxx_jp` 字段，模板靠 helper 选：

```php
$jp = wx_is_jp();          // true if ?wxlang=jp or cookie
wx_field('hero_title')     // returns hero_title_jp if $jp, else hero_title_zh
wx_sub_field('text')       // same for ACF sub-fields
```

`?wxlang=jp` 会写 cookie 持久 30 天。**不能用 `?lang=`**，那是 WP 保留 query var。

切换链接由 `wx_switch_url()` 生成，header.php 里渲染。

---

## 日常维护工作流

### 改文字 / 图片 / 加新闻 / 加产品
**走 wp-admin，不用碰 git**：

1. 登 https://wx-jyy.changhai.me/wp-admin
2. 改完保存
3. 前台立即生效（CSS 用 `?ver=filemtime` 时间戳缓存破解，但 Cloudflare 边缘可能缓存几分钟）

### 改样式 / PHP / 模板结构
**走 git**：

```bash
# 编辑 theme/wx-djy/style.css 或 templates/*.php
git add -A && git commit -m "..." && git push
# 等 ~30s GitHub Actions 跑完
```

GitHub Actions 只触发 sync theme，**不会动数据库或 uploads**。

### 本地预览
官方 `wordpress:6-php8.3-apache` 镜像跑 docker-compose 太啰嗦——直接 push 到 master 看效果最快（30 秒部署）。如果非要本地，可以装 LocalWP + 把 theme 软链过去，但跟生产差异大。

### 看 pod 日志
```bash
kubectl --context=haiaks -n wx-jyy logs deploy/wx-jyy --tail=50
kubectl --context=haiaks -n wx-jyy logs deploy/mariadb --tail=50
```

### 进 pod 跑 wp-cli
```bash
POD=$(kubectl --context=haiaks -n wx-jyy get pod -l app=wx-jyy -o jsonpath='{.items[0].metadata.name}')
kubectl --context=haiaks -n wx-jyy exec -it $POD -- bash
cd /var/www/html
wp --allow-root <command>
```

常用：
- `wp option update blogname 'xxx'`
- `wp post list --post_type=news`
- `wp media import /path/to/file.jpg`

### 备份
**当前没有自动备份**。手动：

```bash
# DB dump
POD=$(kubectl -n wx-jyy get pod -l app=mariadb -o jsonpath='{.items[0].metadata.name}')
kubectl --context=haiaks -n wx-jyy exec $POD -- bash -c 'mariadb-dump -uroot -p$MARIADB_ROOT_PASSWORD wordpress' > backup.sql

# Uploads tarball
POD=$(kubectl -n wx-jyy get pod -l app=wx-jyy -o jsonpath='{.items[0].metadata.name}')
kubectl --context=haiaks -n wx-jyy exec $POD -- tar c /var/www/html/wp-content/uploads | gzip > uploads.tar.gz
```

未来可加 CronJob，TODO。

---

## 关键决策与坑

### 为什么不用 ACF Repeater
**ACF 免费版不支持 Repeater 字段**（只是 PRO 功能，$59/年）。所以"业务卡片"、"工厂照片"、"服务领域"等本来该是 repeater 的内容，全拆成独立 CPT。每条一篇 post，跟发新闻一样的体验。

如果以后想用 ACF Pro，把数据迁回 repeater 也可以，但 CPT 方案有个好处：每条记录可以**独立排序、增删、附图、翻译**，比 repeater 灵活。

### 为什么所有内容都挂在"首页"page 上
ACF Options Page 也是 PRO 功能。免费版只能挂在 page/post/CPT 上。所以站点全局设置（联系方式、公司概要、SEO meta）都挂在首页 page，模板用 `wx_options_pid()` 解析到首页 ID。

### 为什么不用主题选项 / Customizer
WP Customizer 实时预览体验好，但要自己 register_setting 一堆 PHP，不如 ACF 字段组省事。

### CSS 缓存
`functions.php` 里 enqueue style.css 时 version 用 `filemtime()`，所以 push 改 CSS 后 URL 自动带新时间戳，Cloudflare 不会咬旧版。

### Cloudflare Tunnel 必须 HTTPS upstream
之前坏过：cloudflared 配 http 到 ingress-nginx → ingress-nginx 加 X-Forwarded-Proto: http → WP 看是 http 永远 301 到自己 → 死循环。修法：cloudflared 直接走 `https://ingress-nginx-controller...:443` + `noTLSVerify: true`。在 `cloudflare/cloudflared-config` ConfigMap 里。

### 媒体库 vs theme/image/
- `theme/image/` 是**初始素材**（git 里）
- 现在媒体库才是权威：`/var/www/html/wp-content/uploads/2026/05/...` 在 PVC 里
- seed 时通过 `_wx_seed_source` post meta 关联，重跑 seed 不重复导入

### 别用"外观→主题文件编辑器"
那会改 pod 里的 theme 文件，但下一次 git push 会被 CI 覆盖。**所有 PHP/CSS 改动必须走 git**。

### Privacy Policy / Sample Page
这俩 WP 安装时默认创建的页面已删（旧 id=2,3）。后台不会再看到。

---

## 已安装插件

| 插件 | 用途 |
|------|------|
| **Advanced Custom Fields** (Free 6.8.1) | 字段组系统 |
| **Forminator** (Lite) | 联系表单：中文 form id=204、日文 form id=205，绑在联系页（id=49）ACF 字段 `contact_form_id` / `contact_form_id_jp`。提交数据存数据库（wp-admin → Forminator → Submissions）+ 发邮件通知 haha1903@gmail.com |
| **WP Mail SMTP** | 接 Resend SMTP 发邮件，配置见下方"邮件 / SMTP"小节 |
| **Wordfence** (Security – Firewall, Malware Scan, and Login Security) | 防火墙 + 扫描 + 登录防护。WAF 走 `auto_prepend_file`，手动加了 `<IfModule php_module>` 段（新版 Apache 模块名变了），见下方"Wordfence WAF"小节 |
| ~~WPForms Lite~~ | 已卸，换 Forminator |
| ~~Wordfence Login Security~~ | 已卸（厂商弃用），合并进主 Wordfence |
| ~~Polylang~~ | 已停用，方案 B 双语字段更简单 |
| ~~Astra / Starter Templates~~ | 早期试过，已不用（主题改自定义了） |

---

## 邮件 / SMTP（Resend）

发件链路：WordPress `wp_mail()` → WP Mail SMTP → Resend SMTP → 收件人邮箱

- **服务商**：[Resend](https://resend.com) 免费档（3000 封/月，100 封/天）
- **API key** 存在 `wp_options.wp_mail_smtp.smtp.pass`（option 内）
- **配置参数**（已写入 DB）：
  - host: `smtp.resend.com`
  - port: `465`
  - encryption: `ssl`
  - auth user: `resend`
  - auth pass: `re_...`（Resend API key，secret，别 commit 进 git）
- **发件人**：`onboarding@resend.dev`（Resend 默认发件邮箱，无需域名验证）
  - from_name: 无锡谛佳扬
- **收件人**：Forminator 两个表单的 `admin-email-recipients` 都设为 `haha1903@gmail.com`
- **测试**：`wp eval 'wp_mail("haha1903@gmail.com","subj","body");'`，去 Resend dashboard → Logs 看送达状态
- **未来优化**：把 `wx-jyy.com` 验证为 Resend 发件域，发件人改 `noreply@wx-jyy.com`，避免被识别为推广邮件（要在 Cloudflare 加 SPF + DKIM + Return-Path DNS）

⚠️ 因为 password 存在 DB option 里（不是 wp-config.php），WP Mail SMTP 后台会提示"不安全"。生产场景如果敏感，把 password 移到 `wp-config.php` 里用 `define( 'WPMS_SMTP_PASS', '...' );` 然后改 option 为空。

---

## Wordfence WAF

主插件 8.2.x 装好之后 WAF 需要 `auto_prepend_file` 模式才能在 PHP 启动前拦截。Wordfence 写的 `.htaccess` 只覆盖了 `<IfModule mod_php5.c>` / `<IfModule mod_php7.c>` / `<IfModule mod_php.c>`，但 `wordpress:6-php8.3-apache` 镜像里 Apache 模块名实际是 `php_module`。**手动在 `.htaccess` 多加一段**：

```apache
<IfModule php_module>
    php_value auto_prepend_file '/var/www/html/wordfence-waf.php'
</IfModule>
```

验证 WAF 是否在跑：

```bash
wp --allow-root eval 'echo defined("WFWAF_RUN_COMPLETE")?"WAF RAN":"WAF NOT RUNNING";'
```

如果 Wordfence "Scan" 报 "1 path skipped: /var/www/html/lost+found"，那是 ext4 文件系统的系统目录，root-only，**直接 Mark as Fixed**（不要去开 "Scan files outside your WordPress installation"，会权限报错）。

---

## 百度地图

联系页 `/lianxi/` 底部嵌了百度地图 JS API。配置字段（ACF）挂在首页 page（id=99）：

- `baidu_map_ak` — 开发者 AK（在 https://lbsyun.baidu.com/ 申请，应用类型选**浏览器端**）
- `baidu_map_lng` / `baidu_map_lat` — 经纬度（拾取工具 https://api.map.baidu.com/lbsapi/getpoint/）
- **Referer 白名单**必须加这几行（百度匹配严格，必须带 `/*`）：

```
*.wx-jyy.changhai.me/*
wx-jyy.changhai.me/*
*.wx-jyy.com/*
wx-jyy.com/*
```

如果保存白名单后浏览器仍报 "APP Referer 校验失败"，等 1-2 分钟生效。

---

## 联系页布局（/lianxi/）

`templates/lianxi.php` 重做过，不是普通模板：

- 顶部 `<h2>` 大标题
- 中间两栏 grid (2fr : 1fr)：
  - 左：在线留言表单（Forminator，按语言切 204 / 205）
  - 右：联系信息卡（公司概要 + 中国/日本两块），软灰背景，sticky 悬浮
- 底部两栏 grid (1fr : 2fr)：
  - 左：原手绘地图（媒体库里的 cn_map）
  - 右：百度地图交互组件（带标注 + 信息窗口）

ACF 字段在"联系页内容"字段组：`contact_form_id` / `contact_form_id_jp` / `contact_form_title_zh` / `contact_form_title_jp` / `contact_intro_zh` / `contact_intro_jp`。

⚠️ `contact_form_id` 是纯数字，不带语言后缀，**模板里必须用 `get_field()` 不能用 `wx_field()`**（后者会强加 `_zh` / `_jp` 后缀）。

---

## wp-cli

Pod 里没预装 wp-cli，每次 pod 重启都会丢。常用安装一行：

```bash
POD=$(kubectl --context=haiaks -n wx-jyy get pod -l app=wx-jyy -o jsonpath='{.items[0].metadata.name}')
kubectl --context=haiaks -n wx-jyy exec $POD -- bash -c '
curl -sS -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
chmod +x /usr/local/bin/wp && wp --version --allow-root
'
```

⚠️ `wp eval` 时会有 `Constant FS_METHOD already defined` 警告——无害（CLAUDE.md 之前 wp-config.php 加了 `define('FS_METHOD','direct')`，wp-cli 自己也定义一遍）。grep 时加 `| grep -v FS_METHOD` 过滤。

`FS_METHOD direct` 是必须的，否则 WP 在更新插件 / 翻译时会保守地选 FTP 方法导致"无法创建目录"。

---

## TODO / Future

- [ ] `wx-jyy.com` zone transfer 完成后挂 DNS（cloudflared route）
- [ ] 数据库 + uploads 自动备份 CronJob（推 Azure Blob 或 GitHub Releases）
- [x] ~~联系表单接通（Forminator + lianxi 模板）~~ ✅ 完成
- [x] ~~邮件发送（WP Mail SMTP + Resend）~~ ✅ 完成
- [ ] 把 `wx-jyy.com` 验证为 Resend 发件域，发件人改 `noreply@wx-jyy.com`
- [ ] SEO sitemap.xml 生成（装 Yoast / Rank Math）
- [ ] Polylang 或 hreflang meta（如果以后想给搜索引擎区分中日版）
- [ ] 后台 CPT 拖拽排序（装 "Post Types Order" 免费插件）

---

## 历史

之前是 2011 年的纯静态 PHP 站（5 个 `*/index.php` + 一坨 CSS/GIF）。改造经过：
1. 抢救老 HTML/CSS/图 → WP 自定义 theme（PHP 模板照搬）
2. 视觉重做 → 删 1300 行老 CSS，新 HP 风格
3. 内容动态化 → 每个 hardcode 文字改 ACF 字段
4. 列表型内容 → 改成 8 个 CPT
5. 改名 wx-jyy-legacy → wx-djy（公司名 佳与阳 → 谛佳扬）

老 git 历史：`cad22e8` 是最后一个老 PHP 站状态，仅供考古。
