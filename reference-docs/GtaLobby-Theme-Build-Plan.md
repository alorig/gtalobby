# GtaLobby.com — Complete Custom Theme Build Plan

**Version:** 1.0 | March 2026  
**Project:** GtaLobby.com WordPress Custom Theme  
**Domain:** gtalobby.com  
**Architecture:** IGNY8 SAG Methodology  
**Prepared by:** Salman (Alorig) for Sakhi Sahil

---

## 1. Project Summary

GtaLobby.com is a GTA resource site covering both GTA 5/Online and GTA 6. The site uses the SAG (Semantic Authority Grid) methodology for SEO structure.

This document is the complete theme build plan — it covers the data structure (post types, taxonomies, custom fields), the presentation layer (templates), the admin layer (settings and content management), and the design system (light theme, typography, responsive). It does not include content or code.

**What the theme must deliver:**

- 7 custom post types with unique custom fields per type
- 9 custom taxonomies mapping to SAG attributes
- 9 categories (one per sector)
- Hub page template (the SAG cluster landing page)
- 7 single post templates (one per post type)
- 9 category archive templates
- Taxonomy archive templates
- Homepage template
- Global layout (header, footer, sidebar, navigation)
- Schema markup per template
- Internal linking system following SAG interlinking rules
- Theme settings pages for full admin control
- Light color scheme, mobile-first, fast-loading

**Scale from SAG niche definition (XLSX):**

| Sector | Category | Clusters | Keywords |
|--------|----------|----------|----------|
| GTA 6 | gta6 | 20 | 300 |
| Cheat Codes & Cheats | cheats | 20 | 300 |
| GTA Online | online | 20 | 300 |
| Mods & Modding | mods | 20 | 300 |
| Cars & Vehicles | cars | 20 | 300 |
| Characters & Story | characters | 15 | 225 |
| Map & Locations | locations | 15 | 225 |
| Money & Business | money | 15 | 225 |
| News & Updates | news | 10 | 150 |
| **Total** | **9 sectors** | **155** | **2,325** |

The 155 clusters become 155 hub pages. Each hub has 10-20 child posts. The infrastructure (post types, taxonomies, templates) is the same regardless of how many clusters or posts exist.

---

## 2. Data Structure

### 2.1 Custom Post Types (7)

Each post type serves a different user intent. WordPress registers them with unique slugs, icons, and archive support.

**Mod Listing (slug: mod)**
- Purpose: Individual mod with download link, screenshots, install steps
- Typical length: 300-600 words
- Primary category: Mods & Modding
- Archive: yes
- URL pattern: /mod/{slug}/

**Guide (slug: guide)**
- Purpose: How-to, walkthrough, strategy, tutorial, anticipation content
- Typical length: 1,000-2,500 words
- Primary category: All categories
- Archive: yes
- URL pattern: /guide/{slug}/

**Ranking (slug: ranking)**
- Purpose: Top 10/20, tier list, best-of, comparison list
- Typical length: 1,500-3,000 words
- Primary category: All categories
- Archive: yes
- URL pattern: /ranking/{slug}/

**Profile (slug: profile)**
- Purpose: Single entity page — a car, character, location, or business
- Typical length: 500-1,200 words
- Primary category: Cars, Characters, Locations, Money, GTA 6
- Archive: yes
- URL pattern: /profile/{slug}/

**Quick Answer (slug: answer)**
- Purpose: Short direct answer targeting featured snippets
- Typical length: 200-500 words
- Primary category: All categories
- Archive: yes
- URL pattern: /answer/{slug}/

**Database (slug: database)**
- Purpose: Comprehensive sortable data table
- Typical length: 1,000-5,000 words
- Primary category: Cheats, Cars, Locations, Money, GTA 6
- Archive: yes
- URL pattern: /database/{slug}/

**Weekly Recap (slug: recap)**
- Purpose: Recurring weekly update post
- Typical length: 500-1,000 words
- Primary category: GTA Online, News
- Archive: yes
- URL pattern: /recap/{slug}/

### 2.2 Taxonomies (9)

Taxonomies represent the dimensional attributes from the SAG niche definition. Each sector has its own 6 attributes, but many attribute names repeat across sectors (Platform, Game Mode, Language). Taxonomies consolidate these into a shared WordPress taxonomy system.

**Taxonomy 1: Game Title (slug: game_title)**
- Applies to: All post types
- Terms: GTA 5, GTA Online, GTA 6, GTA Series, GTA San Andreas DE, GTA Vice City DE, GTA 3 DE
- SAG role: Distinguishes which game the content covers. Critical for the dual GTA 5 + GTA 6 architecture.

**Taxonomy 2: Platform (slug: platform)**
- Applies to: All post types
- Terms: PS5, PS4, Xbox Series X, Xbox One, PC, All Platforms, Mobile, Nintendo Switch, Cross-Platform, FiveM, RAGEMP
- SAG role: Maps to Platform attribute across GTA 6, Cheats, GTA Online, Mods, News sectors. Cheats sector uses Platform as primary attribute for cluster formation.

**Taxonomy 3: Cheat Type (slug: cheat_type)**
- Applies to: Guide, Database, Answer
- Terms: Vehicle Spawn, Weapon, Player (Invincibility/Health), World (Weather/Gravity), Wanted Level, Money/Exploit, Phone Number, All Cheats
- SAG role: Maps to Cheat Type attribute in the Cheats sector. Used for cluster formation (e.g. Platform: PS5 × Type: All).

**Taxonomy 4: Vehicle Class (slug: vehicle_class)**
- Applies to: Profile, Ranking, Database
- Terms: Supercars, Sports, Muscle, JDM/Tuner, SUV, Bikes/Motorcycles, Off-Road, Luxury, Classic, Emergency, Military, Boats, Aircraft, Weaponized
- SAG role: Maps to Vehicle Class attribute in Cars sector. Used for cluster formation (e.g. Class: All × Criteria: Top Speed).

**Taxonomy 5: Mod Category (slug: mod_category)**
- Applies to: Mod Listing, Ranking, Guide
- Terms: Vehicle Mods, Script Mods, Graphics/Visual, Map/World, Player/Character, Weapon, Sound/Audio, Menu/Trainer, LSPDFR/Police, Total Conversion
- SAG role: Maps to Mod Category attribute in Mods sector.

**Taxonomy 6: Game Mode (slug: game_mode)**
- Applies to: All post types
- Terms: Story Mode, GTA Online, FiveM/RP, Both, Online Racing, Online Freemode
- SAG role: Maps to Game Mode attribute across Cars, Map, Money sectors.

**Taxonomy 7: Business Type (slug: business_type)**
- Applies to: Guide, Ranking, Database, Profile
- Terms: CEO Office, MC Club, Bunker, Nightclub, Acid Lab, Agency, Auto Shop, Salvage Yard, Arcade, Hangar, Facility, Casino
- SAG role: Maps to Business Type attribute in GTA Online and Money sectors. Used for cluster formation (e.g. Business: Nightclub × Intent: Guide).

**Taxonomy 8: Difficulty Level (slug: difficulty)**
- Applies to: Guide, Ranking
- Terms: Beginner, Intermediate, Advanced
- SAG role: Maps to Difficulty/Skill Level attribute across Mods and general sectors.

**Taxonomy 9: Content Tags (slug: content_tags)**
- Applies to: All post types
- Terms: Free-form. Used for cross-referencing that doesn't fit other taxonomies. Also handles: Content Phase (Pre-Launch, Launch Week, Post-Launch, Evergreen), Collectible Type (Treasure Hunt, Spaceship Parts, Letter Scraps, Peyote, etc.), Ranking Criteria (Top Speed, Lap Time, Drift Rating), Update Type (Weekly, DLC, Patch, Seasonal), and any other attributes that are too specific for their own taxonomy.
- SAG role: Catch-all for dimensional attributes that appear in only 1-2 sectors.

### 2.3 Categories (9)

Categories are the top-level navigation silos. Each maps to one SAG sector. Every piece of content belongs to exactly one category.

| # | Category | Slug | Nav Position |
|---|----------|------|-------------|
| 1 | GTA 6 | gta6 | 1st (after Home) |
| 2 | Cheat Codes & Cheats | cheats | 2nd |
| 3 | GTA Online | online | 3rd |
| 4 | Mods & Modding | mods | 4th |
| 5 | Cars & Vehicles | cars | 5th |
| 6 | Characters & Story | characters | 6th |
| 7 | Map & Locations | locations | 7th |
| 8 | Money & Business | money | 8th |
| 9 | News & Updates | news | 9th |

GTA 6 is positioned first because it has the highest search volume (2.67M US monthly) and signals to Google that this is a current, authoritative GTA resource.

### 2.4 Custom Fields

Custom fields are the data layer for each post type. They store structured information that templates render.

#### Mod Listing Fields

| Field | Type | Description |
|-------|------|-------------|
| download_url | URL | External download link |
| mod_version | Text | Current version (e.g. v2.1) |
| file_size | Text | File size (e.g. 45 MB) |
| install_steps | Repeater | Step-by-step install instructions (step_number, step_text) |
| screenshots | Gallery | Mod screenshot gallery |
| compatibility | Checkbox | Compatible game versions |
| author_name | Text | Mod creator name |
| last_tested | Date | When mod was last verified working |
| requirements | Textarea | Required tools (OpenIV, Script Hook V, etc.) |

#### Guide Fields

| Field | Type | Description |
|-------|------|-------------|
| difficulty_rating | Select | Easy / Medium / Hard |
| time_to_complete | Text | Estimated time (e.g. 15 minutes) |
| tools_needed | Text | Required software or in-game items |
| video_embed | URL | YouTube video embed URL |
| step_count | Number | Total steps in guide |

#### Ranking Fields

| Field | Type | Description |
|-------|------|-------------|
| ranked_items | Repeater | Each item: rank, name, image, score, description, pros, cons |
| ranking_criteria | Textarea | How items were evaluated |
| last_tested_date | Date | When rankings were last verified |
| total_items | Number | Number of items ranked |

#### Profile Fields

| Field | Type | Description |
|-------|------|-------------|
| entity_type | Select | Character / Vehicle / Location / Business |
| stats_table | Repeater | Stat name + stat value pairs |
| gallery | Gallery | Entity image gallery |
| related_profiles | Relationship | Links to related profile posts |
| first_appearance | Text | Game/mission where entity first appears |
| voice_actor | Text | Voice actor name (characters only) |

#### Quick Answer Fields

| Field | Type | Description |
|-------|------|-------------|
| short_answer | Textarea | 2-3 sentence direct answer (featured snippet target) |
| sources | Repeater | Source name + URL pairs |
| related_questions | Repeater | Related PAA questions with links |

#### Database Fields

| Field | Type | Description |
|-------|------|-------------|
| table_data | Repeater | Dynamic table rows with configurable columns |
| data_source | Text | Where the data comes from |
| last_updated | Date | When data was last refreshed |
| sortable_columns | Checkbox | Which columns users can sort by |
| filter_taxonomies | Relationship | Which taxonomy terms to offer as filters |

#### Weekly Recap Fields

| Field | Type | Description |
|-------|------|-------------|
| week_date_range | Text | e.g. March 6-13, 2026 |
| bonuses | Repeater | Bonus name + multiplier (2x, 3x) |
| discounts | Repeater | Item + discount percentage |
| new_content | Textarea | New additions this week |
| podium_vehicle | Text | Lucky Wheel vehicle this week |

#### Hub Page Fields (applied to pages using hub template)

| Field | Type | Description |
|-------|------|-------------|
| hub_cluster_name | Text | Cluster name from XLSX |
| hub_sector | Select | Which sector this cluster belongs to |
| hub_attribute_intersection | Text | e.g. "Class: All × Criteria: Top Speed" |
| hub_primary_keyword | Text | Main target keyword |
| hub_quick_answer | Textarea | 2-3 sentence featured snippet answer |
| hub_cross_cluster_links | Relationship | Links to 2-3 related hub pages |
| hub_child_posts | Relationship | Child posts in this cluster (manual or auto by tag) |
| hub_faq_items | Repeater | Question + answer pairs for FAQ section |

#### GTA 6 Anticipation Fields (cross-post-type, applied to any post in GTA 6 category)

| Field | Type | Description |
|-------|------|-------------|
| confidence_level | Select | Confirmed / Likely / Rumored / Speculative |
| source_url | URL | Link to original source (trailer, Rockstar, leaker) |
| source_type | Select | Official Rockstar / Trailer Analysis / Datamine / Leaker / Speculation / Press |
| last_verified | Date | When info was last checked |
| post_launch_update_needed | True/False | Flag for rewrite after GTA 6 launches |
| replaces_url | URL | Post-launch replacement URL if applicable |

---

## 3. Template Layer

### 3.1 Design System

**Color Scheme: Light**
- Background: clean white/off-white
- Text: dark gray/near-black for readability
- Accent: a strong primary color (to be decided — likely a deep blue or green that fits gaming without being garish)
- Secondary accent: for badges, tags, highlights
- Cards/surfaces: very subtle gray background
- Borders: light gray, thin

**Typography:**
- Display/headings: a bold, distinctive font that feels gaming-adjacent but readable
- Body: clean sans-serif optimized for long-form reading
- Monospace: for cheat codes, stats, technical data

**Layout principles:**
- Mobile-first responsive (breakpoints: 320, 768, 1024, 1280)
- Max content width: 1200px
- Main content + sidebar layout on desktop, single column on mobile
- Generous whitespace, scannable sections
- Fast-loading: target 90+ PageSpeed score

### 3.2 Hub Page Template (page-hub.php)

The hub page is the SAG cluster landing page. It's the most important template — it serves as a mini-website for its topic.

**What drives the hub page:**
- The cluster's keywords define what content sections exist
- The cluster's child posts (various post types) fill the grid
- The cluster's related clusters (shared attributes) define cross-links
- The cluster's taxonomy connections define sidebar links

**Template zones (configurable through theme settings):**

**Zone 1: Breadcrumb**
- Path: Home → Category → Hub
- Schema: BreadcrumbList
- Interlinking: Type 6 (structural, not counted toward density)

**Zone 2: Hub header**
- H1 title (from post title or hub_primary_keyword field)
- Quick answer box (from hub_quick_answer field) — featured snippet target
- Metadata: last updated date, category badge, attribute intersection badge
- GTA 6 only: confidence badge (from confidence_level field)

**Zone 3: Table of contents**
- Auto-generated from H2 headings in body content
- Jump links for in-page navigation

**Zone 4: Body content area**
- The main content editor area — written content goes here
- This is where keywords drive what sections get written
- Contains in-body links: Type 2 (to children), Type 4 (to cross-cluster hubs), Type 5 (to taxonomy term pages)
- Link density: 1-2 per 300 words in body

**Zone 5: Structured data section**
- Renders differently based on what data exists
- If ranked_items field has data → shows ranking table
- If table_data field has data → shows sortable data table
- If stats_table field has data → shows stats card
- This zone is flexible — it renders whatever structured content the hub has

**Zone 6: Child posts grid**
- Pulls all posts assigned to this hub (via hub_child_posts relationship or matching tag)
- Displays as card grid with: title, excerpt, post type badge, thumbnail
- Grouped by post type or sub-topic (configurable)
- Interlinking: Type 2 (hub links down to all children)

**Zone 7: Cross-cluster links**
- Pulls from hub_cross_cluster_links relationship field
- Shows 2-3 related hub pages from other clusters
- Interlinking: Type 4 (hub links across to related hubs sharing attribute values)

**Zone 8: FAQ section**
- Pulls from hub_faq_items repeater field
- Accordion-style Q&A
- Schema: FAQPage
- FAQ answers can contain links to child posts (Type 2)

**Zone 9: Sidebar**
- Related hubs from same category (configurable count)
- Taxonomy term links relevant to this hub
- Category archive link
- Popular posts widget
- Ad slot (configurable)

**Zone 10: GTA 6 update notice (conditional)**
- Only shows on GTA 6 category posts
- "This article will be updated when GTA 6 launches" banner
- Source citations from source_url and source_type fields
- post_launch_update_needed flag indicator

**Hub page settings (admin-configurable):**
- Number of child posts to display per group
- Whether to group by post type or by tag
- Number of related hubs in sidebar
- Which taxonomy terms to show in sidebar
- FAQ section on/off
- Cross-cluster section on/off
- Ad slot positions

### 3.3 Single Post Templates (7)

Each post type gets its own template that renders its specific custom fields.

**single-mod.php (Mod Listing)**
- Sections: hero image, title + metadata, download button (prominent), description, install steps (accordion or numbered), screenshots gallery, requirements/compatibility sidebar, related mods
- Schema: SoftwareApplication
- Interlinking: mandatory link to parent hub in first 2 paragraphs

**single-guide.php (Guide)**
- Sections: title + metadata (difficulty badge, time estimate), TOC, step-by-step body content, video embed, tools needed sidebar, related guides
- Schema: HowTo (if step-by-step) or Article
- Interlinking: mandatory hub link, sibling links, cross-cluster if relevant

**single-ranking.php (Ranking)**
- Sections: title + criteria explanation, numbered item cards (rank, name, image, score, pros/cons), comparison overview, platform filter, related rankings
- Schema: ItemList
- Interlinking: mandatory hub link, items can link to their profile pages

**single-profile.php (Profile)**
- Sections: entity header (image + stats table), voice actor/first appearance, body content, gallery, related profiles grid
- Schema: Article
- Interlinking: mandatory hub link, links to related profiles and relevant term pages

**single-answer.php (Quick Answer)**
- Sections: large answer box (featured snippet target), supporting explanation below, source citations, related questions
- Schema: FAQPage
- Interlinking: mandatory hub link, links to related answers in cluster

**single-database.php (Database)**
- Sections: title + description, sortable/filterable table, search bar, platform/taxonomy filter tabs, data source citation, last updated date
- Schema: Dataset + ItemList
- Interlinking: mandatory hub link, links to relevant term pages

**single-recap.php (Weekly Recap)**
- Sections: week date header, bonuses list with multipliers, discounts grid, new content highlights, podium vehicle, links to relevant guides
- Schema: Article with dateModified
- Interlinking: mandatory hub link, links to related guides/businesses mentioned

**Common elements on ALL single templates:**
- Breadcrumb (Zone 1 — same as hub)
- Post type badge
- Category and taxonomy tags
- Social share buttons
- Author/published date
- Related posts section (Type 7: cross-cluster semantic — 2-3 posts from other clusters)
- Comments section
- Sidebar (same sidebar system as hub page)

### 3.4 Archive Templates (9 categories + taxonomy archives)

Each category gets its own archive template. All follow the same structure but can have category-specific customizations.

**Archive structure (all categories):**
- Category header: name, description, keyword context
- Hub pages pinned to top (hub pages for this category displayed first)
- Post type filter tabs: Guide | Answer | Database | Ranking | Profile | Mod | Recap
- Post grid (cards with title, excerpt, post type badge, thumbnail)
- Pagination (configurable posts per page)
- Sidebar with sub-navigation

**Category-specific notes:**
- archive-gta6.php: confidence badges on cards, "pre-launch / confirmed" filters
- archive-cheats.php: platform filter tabs prominent (PS5, PS4, Xbox, PC)
- archive-online.php: "this week" highlight for latest recap, business filters
- archive-mods.php: mod category filters, download count on cards
- archive-cars.php: vehicle class filters, speed stats preview on cards
- archive-characters.php: character avatar thumbnails, game filter
- archive-locations.php: collectible type filters, daily updated badge for gun van
- archive-money.php: business type filters, profit indicators
- archive-news.php: timeline/chronological view, recency badges

**Taxonomy archive templates:**
- taxonomy-game_title.php: all posts for a specific game
- taxonomy-platform.php: all posts for a specific platform
- taxonomy-game_mode.php: all posts for a game mode
- taxonomy-vehicle_class.php: all vehicles in a class
- taxonomy-mod_category.php: all mods in a category
- taxonomy-business_type.php: all content for a business type
- taxonomy-cheat_type.php: all cheats of a type
- taxonomy-difficulty.php: all content at a difficulty level

All taxonomy archives follow the same card grid layout with post type badges.

### 3.5 Homepage (front-page.php)

The homepage is the T1 authority entry point. It links to sector landing pages and top cluster hubs.

**Sections:**
- Hero: GTA 6 featured content (highest volume category)
- Category grid: 9 category cards linking to each category archive
- Featured hubs: configurable selection of top hub pages across categories
- Latest content: most recent posts auto-populated
- Weekly recap highlight: current GTA Online weekly update
- Mod spotlight: featured mod cards (if Mods category active)

**Interlinking:** Min 5, max 15 outbound links to top hubs and sector pages.

**All homepage sections are configurable through theme settings — which hubs to feature, how many per section, section order, on/off toggles.**

### 3.6 Global Layout

**header.php**
- Logo
- Main navigation: Home | GTA 6 | Cheats | Cars | Mods | GTA Online | Characters | Locations | Money | News
- Search bar
- Mobile hamburger menu
- Sticky on scroll (optional, configurable)

**footer.php**
- All 9 category links
- About section
- Social media links
- Copyright
- Organization schema

**sidebar.php**
- Contextual: shows different content based on what page you're on
- On hub pages: related hubs, taxonomy links, popular in cluster
- On single posts: parent hub link, siblings, popular in category
- On archives: sub-filters, popular posts
- Ad slots (configurable positions)

**404.php**
- Search box
- Popular hub links
- Category grid
- No orphan dead ends

**searchform.php**
- Search input
- Post type filter dropdown
- Category filter dropdown

---

## 4. Schema Markup

Schema is injected per template through a dedicated include file.

| Schema Type | Applied To | Key Fields |
|-------------|-----------|------------|
| Article | All post types + hub pages | headline, datePublished, dateModified, author, publisher, image |
| FAQPage | Hub pages (FAQ zone), Quick Answers | mainEntity array of Question/Answer |
| HowTo | Guide posts with steps | name, step array, totalTime |
| ItemList | Rankings, Databases | itemListElement with position, name, url |
| SoftwareApplication | Mod Listings | name, operatingSystem, downloadUrl, fileSize |
| BreadcrumbList | All pages | itemListElement with position, name, item |
| VideoObject | Posts with YouTube embeds | name, description, thumbnailUrl, contentUrl |
| Organization | Footer (site-wide) | name, url, logo, sameAs |

dateModified auto-updates on every edit — critical for GTA 6 freshness signals.

---

## 5. Internal Linking System

Based on the SAG Interlinking Specification (Doc 3). The theme provides the infrastructure for linking — helper functions, template zones, and admin tools. Actual link creation happens through content authoring and theme settings.

### 5.1 Link Types the Theme Supports

| Type | Direction | Where in Template | How It Works |
|------|-----------|------------------|--------------|
| Type 1: Vertical up | Child → Hub | Single templates (first 2 paragraphs) | Editor reminder + hub link widget in sidebar |
| Type 2: Vertical down | Hub → Children | Hub Zone 4 (body) + Zone 6 (grid) | Auto-populated from hub_child_posts field |
| Type 3: Sibling | Child ↔ Child | Single templates (related posts) | Query siblings in same cluster, max 2 |
| Type 4: Cross-cluster | Hub ↔ Hub | Hub Zone 4 (body) + Zone 7 (section) | From hub_cross_cluster_links field |
| Type 5: Taxonomy | Term Page → Hubs | Taxonomy archives | Auto-link to all hubs using that term |
| Type 6: Breadcrumb | Structural | All templates (top) | Auto-generated from hierarchy |
| Type 7: Related | Cross-cluster semantic | Single templates (bottom) | 2-3 posts from other clusters |

### 5.2 Link Density Rules

| Page Type | Min Outbound | Max Outbound | Notes |
|-----------|-------------|-------------|-------|
| Hub Page | 5 | 20 (25 if 10+ children) | Must link to all children + 2 cross-cluster |
| Single Post (<1000w) | 2 | 5 | Must include hub link |
| Single Post (1000-2000w) | 3 | 8 | Must include hub link |
| Single Post (2000+w) | 4 | 12 | Must include hub link |
| Homepage | 5 | 15 | Links to top hubs + categories |

Breadcrumbs and navigation sections don't count toward density.

### 5.3 Anchor Text Rules

- No exact-match anchor used more than 3 times site-wide for same target URL
- Min 2 words, max 8 words
- Never "click here", "read more", "this article"
- Must be grammatically natural in context

---

## 6. Theme Settings & Admin

### 6.1 Theme Settings Pages

**GtaLobby General Settings** (Appearance → GtaLobby Settings)
- Site logo and favicon
- Social media URLs
- Analytics tracking code
- Default OG image
- Color accent override
- Global ad code (header, footer)

**Homepage Settings** (Appearance → GtaLobby → Homepage)
- Hero section: select featured hub or post
- Featured hubs: select which hubs appear, how many
- Section order: drag-and-drop section reordering
- Section toggles: on/off per section
- Latest posts count

**Hub Page Settings** (Appearance → GtaLobby → Hub Pages)
- Default child posts per group
- Group by: post type or tag
- Related hubs count in sidebar
- FAQ section default: on/off
- Cross-cluster section default: on/off
- Ad slot positions within hub layout
- Structured data section: auto-detect or manual

**SEO Settings** (Appearance → GtaLobby → SEO)
- Default schema toggles per post type
- Breadcrumb format options
- dateModified auto-update: on/off
- Canonical URL rules
- Sitemap inclusion rules per post type

**Monetization Settings** (Appearance → GtaLobby → Ads)
- Ad slot management: header, sidebar, in-content, between-posts, footer
- Affiliate link defaults
- AdSense integration code
- Ad display rules (hide on certain post types, minimum word count before showing)

**GTA 6 Content Manager** (Appearance → GtaLobby → GTA 6)
- List all GTA 6 posts with confidence_level and last_verified
- Batch update confidence levels
- Flag posts for post-launch rewrite
- Filter by: needs update, confirmed, rumored, speculative

### 6.2 Admin Enhancements

**Custom columns in post list tables:**
- Category, hub assignment, post type icon, platform tags, word count
- GTA 6 posts: confidence badge, last verified date

**Quick edit additions:**
- Platform taxonomy
- Game title taxonomy
- Confidence level (GTA 6)
- Hub page assignment

**Bulk actions:**
- Assign to hub
- Set confidence level
- Flag for post-launch update
- Change category

**Dashboard widget:**
- Posts per category count
- Hub coverage percentage (how many hubs have content)
- Recent publishes
- Missing hub pages alert

**Editor sidebar panel (meta box):**
- Shows assigned hub page
- Cluster info (attribute intersection)
- Required links checklist (hub link present? density OK?)
- Post type-specific field summary

---

## 7. URL Architecture

| Content | URL Pattern | Example |
|---------|------------|---------|
| Homepage | / | gtalobby.com/ |
| GTA 6 Hub | /gta6/{slug}/ | /gta6/gta-6-map-everything-we-know/ |
| GTA 5 Hub | /{category}/{slug}/ | /cheats/gta-5-cheat-codes-ps5/ |
| Guide | /guide/{slug}/ | /guide/how-to-register-as-ceo-gta-5/ |
| Ranking | /ranking/{slug}/ | /ranking/fastest-cars-gta-5/ |
| Profile | /profile/{slug}/ | /profile/trevor-phillips/ |
| Quick Answer | /answer/{slug}/ | /answer/is-gta-5-crossplay/ |
| Mod Listing | /mod/{slug}/ | /mod/ferrari-laferrari-gta-v/ |
| Database | /database/{slug}/ | /database/all-gta-5-cheat-codes/ |
| Weekly Recap | /recap/{slug}/ | /recap/gta-online-weekly-march-13-2026/ |
| Category Archive | /{category}/ | /gta6/ or /cheats/ or /cars/ |
| Taxonomy Archive | /{taxonomy}/{term}/ | /platform/ps5/ or /vehicle-class/supercars/ |

---

## 8. Theme File Structure

```
gtalobby-theme/
├── style.css                    — Theme declaration + all styles
├── functions.php                — Master file, includes all inc/ files
├── screenshot.png               — Theme preview
│
├── front-page.php               — Homepage
├── header.php                   — Global header + nav
├── footer.php                   — Global footer + Organization schema
├── sidebar.php                  — Contextual sidebar
├── searchform.php               — Custom search with filters
├── 404.php                      — Custom 404
├── comments.php                 — Styled comments
│
├── page-hub.php                 — Hub page template (SAG cluster page)
│
├── single-mod.php               — Mod listing template
├── single-guide.php             — Guide template
├── single-ranking.php           — Ranking template
├── single-profile.php           — Profile template
├── single-answer.php            — Quick answer template
├── single-database.php          — Database template
├── single-recap.php             — Weekly recap template
│
├── archive.php                  — Default archive fallback
├── archive-gta6.php             — GTA 6 category archive
├── archive-cheats.php           — Cheats category archive
├── archive-online.php           — GTA Online category archive
├── archive-mods.php             — Mods category archive
├── archive-cars.php             — Cars category archive
├── archive-characters.php       — Characters category archive
├── archive-locations.php        — Locations category archive
├── archive-money.php            — Money category archive
├── archive-news.php             — News category archive
│
├── taxonomy-game_title.php      — Game title term archive
├── taxonomy-platform.php        — Platform term archive
├── taxonomy-game_mode.php       — Game mode term archive
├── taxonomy-vehicle_class.php   — Vehicle class term archive
├── taxonomy-mod_category.php    — Mod category term archive
├── taxonomy-business_type.php   — Business type term archive
├── taxonomy-cheat_type.php      — Cheat type term archive
├── taxonomy-difficulty.php      — Difficulty term archive
│
├── inc/
│   ├── post-types.php           — Register 7 custom post types
│   ├── taxonomies.php           — Register 9 taxonomies + 9 categories + terms
│   ├── custom-fields.php        — ACF field groups (all post types + hub + GTA 6)
│   ├── schema.php               — JSON-LD structured data per template
│   ├── interlinking.php         — Link helpers (hub link widget, sibling query, cross-cluster)
│   ├── admin-settings.php       — Theme settings pages + admin enhancements
│   ├── enqueue.php              — Script/style enqueuing + performance
│   ├── breadcrumbs.php          — Breadcrumb generation with BreadcrumbList schema
│   └── template-tags.php        — Reusable functions (badges, metadata, cards)
│
├── js/
│   ├── navigation.js            — Mobile menu + search toggle
│   └── sortable-table.js        — Client-side table sorting for databases
│
└── assets/
    └── (images, icons as needed)
```

---

## 9. Build Order

| Session | What Gets Built | Depends On |
|---------|----------------|------------|
| 1 | style.css (theme declaration + design system), functions.php (master), inc/post-types.php (7 post types) | Nothing |
| 2 | inc/taxonomies.php (9 taxonomies + 9 categories + all terms) | Session 1 |
| 3 | inc/custom-fields.php (all field groups for all post types + hub + GTA 6) | Session 1-2 |
| 4 | header.php, footer.php, sidebar.php, 404.php, searchform.php, comments.php, inc/enqueue.php | Session 1 |
| 5 | page-hub.php, inc/breadcrumbs.php, inc/template-tags.php | Session 1-3 |
| 6 | single-guide.php, single-answer.php, single-mod.php | Session 5 |
| 7 | single-ranking.php, single-profile.php, single-database.php, single-recap.php | Session 5 |
| 8 | archive.php, archive-gta6.php, archive-cheats.php, archive-online.php, archive-mods.php | Session 5-6 |
| 9 | archive-cars.php through archive-news.php + all taxonomy archives | Session 8 |
| 10 | front-page.php (homepage) | Session 4-6 |
| 11 | inc/schema.php (all schema types) | Session 5-7 |
| 12 | inc/interlinking.php (link helpers + hub link widget) | Session 5-11 |
| 13 | inc/admin-settings.php (all settings pages + admin enhancements) | Session 1-12 |
| 14 | style.css (complete light theme styling for all templates), js/ files | All sessions |
| 15 | Testing, mobile testing, PageSpeed optimization, content population test | All sessions |

---

## 10. Cross-References

| Document | What It Provides |
|----------|-----------------|
| GtaLobby Architecture PDF v2 | 9 categories, 7 post types, hub page structure, URL architecture, content schedule, SEO strategy, monetization plan, 18-month roadmap |
| SAG Niche Definition XLSX (Complete) | 9 sectors, 155 clusters, 2,325 keywords, 54 attributes (6 per sector), cluster names, attribute intersections, hub page titles |
| SAG Interlinking Specification (Doc 3) | 7 link types, link density rules, anchor text rules, scoring algorithm, link injection zones, authority flow model, health score calculation |

---

*GtaLobby.com | 7 Post Types | 9 Taxonomies | 9 Categories | 155 Hub Pages | 2,325 Keywords*  
*Built by Salman (Alorig) for Sakhi Sahil | IGNY8 SAG Methodology | March 2026*
