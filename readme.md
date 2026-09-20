# Madeleine Enberg — portfolio

Personal portfolio site for a photographer and web developer. Two entry points
from the front page — **photographer** and **developer** — plus a gallery
archive and a contact form.

Live: <https://madeleineenberg.com>

## Stack

| | |
|---|---|
| CMS | WordPress multisite — subdirectory install, classic (not Bedrock) |
| Theme | oTheme — Sage 10 + [Acorn](https://roots.io/acorn/), PHP 8 |
| Templating | Blade, with Acorn View Composers for data |
| Fields & blocks | ACF Pro, blocks auto-registered from Blade files |
| Scripts | TypeScript, bundled with Laravel Mix (webpack) |
| Styles | SCSS, Bootstrap 5 grid, PurgeCSS in production |
| Motion | GSAP, Locomotive Scroll, anime.js, SplitType, Splide |

## The theme

The site runs on **oTheme**, the in-house base package we build client sites on
at [Osolo](https://osolo.se/). oTheme is a [Roots](https://roots.io/) stack in
two halves: Bedrock for the install and configuration layer, and Sage 10 with
Acorn for the theme — Blade templating, View Composers and a Laravel-style
container inside WordPress. On top of that foundation oTheme adds what we share
across projects: the ACF block registration, the SCSS structure and the build
pipeline.

**This site only uses the Sage half.** It runs as a classic WordPress install
rather than a Bedrock one, so none of the Bedrock configuration layer applies
here. Two leftovers from an unfinished Bedrock scaffold are still visible: the
`composer.json` in the repository root is Bedrock's, and there is a second,
Composer-managed WordPress core in `wp/`. Neither is what boots the site —
`ABSPATH` points at the repository root and loads the core there.

I'm one of the developers behind oTheme, so the base architecture is work I've
been part of building rather than something I only inherited. What is specific
to this repository is the portfolio itself — the design, the blocks and
templates, the styling and the animation layer.

## Repository layout

The repository root is the WordPress install root. Almost everything in it is
gitignored — only the theme and the root Composer files are tracked. WordPress
core, plugins and uploads are not in version control.

```
wp-content/themes/osolo/
├── app/
│   ├── View/Composers/     data for the Blade views, one class per view
│   ├── Routes/             REST route callbacks
│   ├── filters.php         theme filters, incl. the WYSIWYG format menu
│   └── setup.php           theme supports, menus, asset enqueue
├── acf-json/               field groups, version controlled
└── resources/
    ├── views/
    │   ├── blocks/         one Blade file per ACF block
    │   └── partials/
    ├── scripts/            TypeScript, entry point app.ts
    └── styles/             SCSS
```

## Blocks

Each file in `resources/views/blocks/` becomes an ACF block automatically, via
`osolo/sage-acf-wp-blocks`. The Blade comment at the top of the file is the
block definition — title, icon, category, supports. A matching class in
`app/View/Composers/` supplies the field data to the view.

Field groups live as JSON in `acf-json/` and are loaded from disk, so adding a
field is a code change rather than a database change.

## Local development

The site runs in [Local](https://localwp.com/) at `multi.local`. From the theme
directory:

```bash
cd wp-content/themes/osolo

bun install
bun run start              # watch + browsersync
bun run build:production   # minified build with PurgeCSS
bun run lint               # eslint + stylelint
```

`bun run build:production` must be run after changing anything in
`resources/` — the built assets in `dist/` are gitignored and not committed.

Because this is a multisite, `wp-config.php` needs the network constants
(`MULTISITE`, `SUBDOMAIN_INSTALL`, `DOMAIN_CURRENT_SITE` and friends) before the
install will boot. `wp-config.php` is not in the repository, so a fresh
environment has to set them by hand. WP-CLI commands that touch the network
need `--url` or `--network`.

## Notes

**Content is not in the repository.** The hero title words and their links come
from an ACF repeater stored in the block's attributes, which lives in the
database. On a fresh environment the hero falls back to plain text without
links until those rows are filled in through the block editor.

**Custom post type `galleri`** backs the gallery archive. Its single template
loads images over the REST route `/wp-json/portfolio/gallery`.

**Lint has two deliberate downgrades.** `@typescript-eslint/no-explicit-any`
and three stylelint rules report as warnings rather than errors — the reasons
are recorded in the commits that set them.
