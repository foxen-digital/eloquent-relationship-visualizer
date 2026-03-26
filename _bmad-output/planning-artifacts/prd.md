---
stepsCompleted: ['step-01-init', 'step-02-discovery', 'step-02b-vision', 'step-02c-executive-summary', 'step-03-success', 'step-04-journeys', 'step-05-domain-skipped', 'step-06-innovation-skipped', 'step-07-project-type', 'step-08-scoping', 'step-09-functional', 'step-10-nonfunctional', 'step-11-polish', 'step-12-complete']
status: complete
classification:
  projectType: developer_tool
  domain: developer_tools
  complexity: medium
  projectContext: greenfield
inputDocuments:
  - docs/laravel-eloquent-relationship-visualizer-package.md
documentCounts:
  briefs: 0
  research: 1
  brainstorming: 0
  projectDocs: 1
workflowType: 'prd'
---

# Product Requirements Document - eloquent-relationship-visualizer

**Author:** Mrdth
**Date:** 2026-03-26

## Executive Summary

**Eloquent Relationship Visualizer** is an open-source Laravel package that automatically generates and maintains relationship documentation from Eloquent model definitions. By parsing model files using PHP AST analysis, it produces committed Markdown documentation with embedded Mermaid diagrams that stay synchronized with code — eliminating documentation drift and reducing onboarding friction for teams working with complex data architectures.

**Target Users:**
- **Laravel development teams** — Reduce onboarding time and maintain accurate relationship documentation across codebase evolution
- **Solo developers** — Generate reference documentation for personal projects without manual maintenance
- **Agencies** — Produce client-ready architecture documentation that remains accurate through project handoffs

**Problem Solved:**
Large Laravel applications accumulate dozens of models with intricate relationships that are difficult to understand from code alone. Existing solutions are either abandoned (beyondcode/laravel-er-diagram), not Laravel-native (DBDiagram.io, MySQL Workbench), or focused on database structure rather than Eloquent's abstraction layer. The deeper problem: relationship documentation becomes stale within days of creation, making it unreliable precisely when teams need it most.

### What Makes This Special

**Core Insight:** Stale documentation is worse than no documentation. The real pain point isn't visualizing relationships — it's keeping documentation accurate as code evolves.

**Differentiation:**
- **Documentation-first output** — Generates committed Markdown + Mermaid that lives in the repo, renders natively on GitHub, and never rots
- **Laravel-native** — Artisan commands, Laravel conventions, zero external service dependencies
- **Eloquent-aware** — Understands polymorphic relationships, custom foreign keys, and Laravel patterns that database-level tools miss
- **Git-friendly artifacts** — Documentation changes are version-controlled alongside code, enabling review and history

**MVP Scope:**
- Automatic relationship detection via PHP AST parsing
- Markdown documentation generation with embedded Mermaid diagrams
- Artisan command (`php artisan relationships:visualize`)
- Configurable output paths and templates

## Project Classification

| Attribute | Value |
|-----------|-------|
| **Project Type** | Developer Tool (Laravel Package) |
| **Domain** | Developer Tools |
| **Complexity** | Medium |
| **Project Context** | Greenfield (new open-source package) |

## Success Criteria

### User Success

**The "Aha" Moment:** When a developer runs `php artisan relationships:visualize` and sees their complete data model rendered as a Mermaid diagram in generated Markdown — instantly comprehensible, no manual effort required.

**Definition of Done:** Documentation generated successfully. Where the user commits or publishes those docs (repo, wiki, documentation site) is outside package scope.

**Success Indicators:**
- Developer can install, configure, and generate docs within 5 minutes of first use
- Generated Mermaid diagrams render correctly on GitHub without modification
- All detected relationships are accurate (no false positives or missing relationships)

### Business Success

**Primary Metric:** Packagist downloads — indicates actual installation and usage, not just interest.

**Year 1 Targets:**
- 5,000+ Packagist downloads (realistic for a niche Laravel developer tool)
- 100+ GitHub stars (indicates community recognition)
- Featured in at least 1 Laravel community resource (newsletter, blog, podcast)

**Established Status (1 Year):**
- Active maintenance with releases for Laravel version updates
- At least 1 community contribution or issue report (indicates real usage)
- Zero open critical bugs

### Technical Success

**Critical Paths (Must Work 100%):**
- **Relationship Detection Accuracy** — All Eloquent relationship types detected correctly; no false positives (detecting relationships that don't exist) or false negatives (missing actual relationships)
- **Mermaid Syntax Validity** — All generated diagrams render without syntax errors on GitHub and other Mermaid renderers

**Compatibility:**
- Supports Laravel versions under active support (currently Laravel 12 & 13)
- Follows Laravel package conventions and patterns

**Quality:**
- 90%+ test coverage
- Zero critical bugs at release

### Measurable Outcomes

| Metric | Target | Timeline |
|--------|--------|----------|
| Packagist downloads | 5,000+ | 12 months |
| GitHub stars | 100+ | 12 months |
| Test coverage | 90%+ | MVP release |
| Critical bugs | 0 | MVP release |
| Laravel versions | 12, 13 | MVP release |

## Product Scope

### MVP - Minimum Viable Product

**Essential for Release:**
- PHP AST parsing for automatic relationship detection
- Support for all standard Eloquent relationship types:
  - `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`
  - `hasOneThrough`, `hasManyThrough`
  - `morphOne`, `morphMany`, `morphTo`, `morphToMany`
- Markdown documentation generation
- Embedded Mermaid diagram output (GitHub-native rendering)
- Artisan command: `php artisan relationships:visualize`
- Configurable output path and templates
- Laravel 12 & 13 support

### Growth Features (Post-MVP)

**Competitive Enhancements:**
- Interactive web UI for graph exploration
- Filter by namespace/folder
- Path highlighting between models
- Additional output formats (JSON, standalone SVG)
- CI/CD integration helpers

### Vision (Future)

**Long-term Possibilities:**
- Real-time file watching and regeneration
- Laravel Debugbar integration
- VS Code extension
- Analysis tools (circular dependencies, missing inverse relationships, N+1 risk indicators)
- Pro version with advanced features

## User Journeys

### Journey 1: Sarah — Solo Developer Exploring a Legacy Codebase

**The Situation:** Sarah inherited a Laravel project from a freelancer who's no longer available. The app has 35 models and she needs to understand the data structure quickly.

**Opening Scene:** Sarah clones the repo, runs `composer install`, and stares at the `app/Models` folder. She opens three model files but can't keep the relationships straight in her head. She's frustrated and worried about breaking something.

**Rising Action:** She remembers seeing a package recommendation. She runs:
```bash
composer require foxen/eloquent-relationship-visualizer --dev
php artisan relationships:visualize
```

**Climax:** A `RELATIONSHIPS.md` file appears in her project root. She opens it on GitHub and sees a clean Mermaid diagram. For the first time, she can see that `Order` connects to `User` through `OrderItem`, which connects to `Product`. The polymorphic `Comment` system suddenly makes sense.

**Resolution:** Within 10 minutes, Sarah understands the data model well enough to start planning her first feature. She commits the docs to the repo as a reference for herself and future maintainers.

### Journey 2: Marcus — Team Lead Onboarding a New Developer

**The Situation:** Marcus's team just hired Alex, a junior developer. The project has 60+ models and onboarding usually takes weeks of "just ask someone" questions.

**Opening Scene:** It's Alex's first day. Marcus wants to give them a self-service way to understand the data architecture without constant hand-holding.

**Rising Action:** Marcus points Alex to the `docs/RELATIONSHIPS.md` file that was generated by the package. "Run `php artisan relationships:visualize` anytime you need a fresh view."

**Climax:** Alex spends their first afternoon exploring the generated docs. They can trace how `Subscription` relates to `Plan` through `SubscriptionItem`, and understand why `Invoice` has both a `customer_id` and a `user_id`. They open a model file, then reference the diagram — no Slack questions needed.

**Resolution:** Alex is productive within days instead of weeks. The documentation stays accurate because it's regenerated when the team changes relationships.

### Journey 3: Priya — Agency Dev Preparing Client Handoff

**The Situation:** Priya's agency is wrapping up a 6-month Laravel project for a client. The client's internal team will take over maintenance.

**Opening Scene:** The handoff meeting is in 3 days. Priya needs to produce architecture documentation that the client's team can actually use.

**Rising Action:** She runs `php artisan relationships:visualize` and gets a complete relationship diagram with documentation. She commits it to the repo and includes it in the handoff documentation.

**Climax:** During handoff, the client's lead dev opens the Mermaid diagram on GitHub. "This is exactly what we needed. We can see how everything connects." No weeks of reverse-engineering the database.

**Resolution:** The client's team has accurate, version-controlled documentation that will stay in sync as they maintain the codebase. Priya's agency looks professional and thorough.

### Journey 4: Jordan — Debugging a Relationship Issue

**The Situation:** Jordan is getting unexpected `null` values when accessing `$user->latestOrder`. The relationship exists but isn't working as expected.

**Opening Scene:** Jordan has been staring at the `User` model for 20 minutes. The relationship method looks correct, but something's off.

**Rising Action:** They run `php artisan relationships:visualize` and check the generated docs. The diagram shows `User` → `Order` with the correct foreign key labeled.

**Climax:** Jordan spots it — the diagram shows `orders.user_id`, but they expected `orders.customer_id`. They check the model and realize the foreign key override is missing.

**Resolution:** The visual diagram helped Jordan spot the mismatch in seconds instead of digging through migrations and model files.

### Journey Requirements Summary

| Journey | Reveals Requirements For |
|---------|-------------------------|
| Sarah (Solo Dev) | Quick installation, minimal config, instant output |
| Marcus (Team Lead) | Commit-friendly output, GitHub rendering, regenerability |
| Priya (Agency) | Professional output quality, handoff-ready docs |
| Jordan (Debugging) | Accurate relationship detection, foreign key visibility |

## Developer Tool Specific Requirements

### Project-Type Overview

This is a **Laravel package** distributed via Composer/Packagist. It follows Laravel package conventions and integrates via Artisan commands. The primary output is generated documentation (Markdown + Mermaid), not a runtime service.

### Language & Runtime Support

| Requirement | Specification |
|-------------|---------------|
| **Language** | PHP 8.2+ (8.1 is EOL) |
| **Framework** | Laravel 12, Laravel 13 |
| **Runtime** | CLI via Artisan (no web runtime required for core functionality) |

### Installation Methods

**Primary Installation:**
```bash
composer require foxen/eloquent-relationship-visualizer --dev
```

**Installation as dev dependency:**
- Recommended as `--dev` since it's a development/documentation tool
- No production runtime impact

**Post-install setup:**
```bash
php artisan vendor:publish --tag=eloquent-visualizer-config
```

### API Surface

**Artisan Command:**
```bash
php artisan relationships:visualize [options]
```

**Options:**
| Option | Description |
|--------|-------------|
| `--output=PATH` | Custom output path for generated docs (default: `RELATIONSHIPS.md`) |
| `--format=FORMAT` | Output format (default: `markdown`) |
| `--models=PATH` | Custom models directory (default: `app/Models`) |
| `--no-diagram` | Generate documentation without Mermaid diagram |

**Configuration File:**
```php
// config/eloquent-visualizer.php
return [
    'output_path' => env('RELATIONSHIPS_OUTPUT_PATH', 'RELATIONSHIPS.md'),
    'models_path' => env('RELATIONSHIPS_MODELS_PATH', app_path('Models')),
    'include_diagram' => true,
    'diagram_direction' => 'TB', // TB, LR, BT, RL
];
```

### Code Examples

**Basic Usage:**
```bash
# Install
composer require foxen/eloquent-relationship-visualizer --dev

# Generate documentation
php artisan relationships:visualize

# Output: RELATIONSHIPS.md created in project root
```

**Custom Output Path:**
```bash
php artisan relationships:visualize --output=docs/DATABASE.md
```

**Programmatic Usage (Future Consideration):**
```php
use Foxen\EloquentRelationshipVisualizer\Generator;

$generator = new Generator();
$markdown = $generator->generate();
```

### Documentation Strategy

**MVP Documentation:**
- **README.md** — Installation, usage, configuration, example output
- **Example output** — Sample `RELATIONSHIPS.md` included in repo and linked from README
- **Changelog** — CHANGELOG.md for version tracking

**Post-MVP (Future):**
- Dedicated documentation site (GitHub Pages or similar)
- API reference documentation

### Real-World Usage Examples

The package will be integrated into Foxen Digital open source projects as live demonstration:
- Provides realistic usage examples beyond synthetic demos
- Demonstrates package behavior on production-scale model sets
- Serves as regression testing for real-world edge cases

### Implementation Considerations

**Package Structure:**
```
foxen/eloquent-relationship-visualizer/
├── src/
│   ├── Commands/
│   │   └── VisualizeRelationshipsCommand.php
│   ├── Parsers/
│   │   ├── ModelParser.php
│   │   └── RelationshipParser.php
│   ├── Generators/
│   │   ├── MarkdownGenerator.php
│   │   └── MermaidGenerator.php
│   └── EloquentVisualizerServiceProvider.php
├── config/
│   └── eloquent-visualizer.php
├── tests/
│   └── ...
├── README.md
├── CHANGELOG.md
├── example-output.md
└── composer.json
```

**Key Dependencies:**
- `nikic/php-parser` — PHP AST parsing for relationship detection
- Laravel framework components (illuminate/support, illuminate/console)

## Project Scoping & Phased Development

### MVP Strategy & Philosophy

**MVP Approach:** Problem-Solving MVP — solves one specific problem well: stale relationship documentation.

**Core Principle:** The "minimum that's useful" — developer runs one command and gets accurate documentation. If relationship detection is wrong or Mermaid doesn't render on GitHub, the package fails. Everything else is enhancement.

**Resource Requirements:** Solo maintainer viable due to lean scope.

### MVP Feature Set (Phase 1)

**Core User Journeys Supported:**
- Sarah (Solo Dev) — Quick installation, minimal config, instant output
- Marcus (Team Lead) — Commit-friendly output, GitHub rendering, regenerability
- Jordan (Debugging) — Accurate relationship detection, foreign key visibility

**Must-Have Capabilities:**
- [ ] PHP AST parsing for automatic relationship detection
- [ ] Support for all standard Eloquent relationship types:
  - `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`
  - `hasOneThrough`, `hasManyThrough`
  - `morphOne`, `morphMany`, `morphTo`, `morphToMany`
- [ ] Markdown documentation generation
- [ ] Mermaid diagram output (GitHub-native rendering)
- [ ] Artisan command: `php artisan relationships:visualize`
- [ ] Configurable output path and templates
- [ ] Laravel 12 & 13 support
- [ ] README + example output documentation
- [ ] 90%+ test coverage

### Post-MVP Features

**Phase 2 (Growth):**
- Interactive web UI for graph exploration
- Namespace/folder filtering
- Path highlighting between models
- JSON output format
- CI/CD integration helpers

**Phase 3 (Expansion):**
- Real-time file watching and regeneration
- Laravel Debugbar integration
- VS Code extension
- Analysis tools (circular dependencies, missing inverse relationships, N+1 risk indicators)
- Pro version with advanced features

### Risk Mitigation Strategy

**Technical Risks:**

| Risk | Likelihood | Mitigation |
|------|------------|------------|
| AST parsing edge cases (dynamic relationships, closures) | Medium | Graceful degradation, docblock annotation fallback |
| Polymorphic relationship complexity | Medium | Comprehensive test suite with real-world examples |
| nikic/php-parser version conflicts | Low | Pin dependency versions, test against multiple versions |

**Market Risks:**

| Risk | Mitigation |
|------|------------|
| Low adoption | Integrate into Foxen Digital OSS projects as live demos |
| Competitor emerges | First-mover advantage in modern Laravel ecosystem |
| Laravel API changes | Support only actively maintained Laravel versions |

**Resource Risks:**

| Risk | Mitigation |
|------|------------|
| Solo maintainer burnout | Keep scope lean, defer complex features |
| Limited testing capacity | Use Foxen Digital projects as regression testbeds |

## Functional Requirements

### Package Installation & Setup

- FR1: Developers can install the package via Composer as a dev dependency
- FR2: Developers can publish the configuration file to customize default behavior
- FR3: Developers can install and generate documentation within 5 minutes of first use

### Model Discovery

- FR4: The system can discover all Eloquent models in a configurable directory path
- FR5: The system can detect relationship definitions from model files without executing PHP code
- FR6: The system can handle models organized in custom namespaces/folders

### Relationship Detection

- FR7: The system can detect `hasOne` relationships from model method definitions
- FR8: The system can detect `hasMany` relationships from model method definitions
- FR9: The system can detect `belongsTo` relationships from model method definitions
- FR10: The system can detect `belongsToMany` relationships from model method definitions
- FR11: The system can detect `hasOneThrough` relationships from model method definitions
- FR12: The system can detect `hasManyThrough` relationships from model method definitions
- FR13: The system can detect `morphOne` relationships from model method definitions
- FR14: The system can detect `morphMany` relationships from model method definitions
- FR15: The system can detect `morphTo` relationships from model method definitions
- FR16: The system can detect `morphToMany` relationships from model method definitions
- FR17: The system can extract foreign key information from relationship definitions
- FR18: The system can identify the related model for each detected relationship
- FR19: The system can handle custom foreign key overrides in relationship definitions

### Documentation Generation

- FR20: The system can generate a Markdown file containing relationship documentation
- FR21: The system can generate a Mermaid diagram visualizing model relationships
- FR22: The system can embed the Mermaid diagram within the Markdown output
- FR23: The system can generate output that renders correctly on GitHub without modification
- FR24: Developers can specify a custom output file path for generated documentation
- FR25: Developers can generate documentation without the Mermaid diagram (text-only)
- FR26: The system can display relationship types in the generated documentation
- FR27: The system can display foreign key names in the generated documentation

### Command Interface

- FR28: Developers can invoke documentation generation via an Artisan command
- FR29: Developers can specify a custom models directory via command option
- FR30: Developers can specify a custom output path via command option
- FR31: The system outputs to console: the count of models discovered, the count of relationships detected, the output file path, and a success or failure message with exit code upon completion

### Configuration

- FR32: Developers can configure the default output path via config file
- FR33: Developers can configure the default models directory via config file
- FR34: Developers can configure whether to include the diagram by default
- FR35: Developers can configure the Mermaid diagram direction (TB, LR, BT, RL)
- FR36: Developers can override configuration via environment variables

## Non-Functional Requirements

### Reliability

- NFR1: Relationship detection accuracy must be 100% — no false positives (detecting non-existent relationships) or false negatives (missing actual relationships) — as measured by automated test suite covering all supported relationship types across a minimum of 20 representative model fixtures
- NFR2: All generated Mermaid diagrams must render without syntax errors on GitHub
- NFR3: The package must fail gracefully when encountering unparseable models (log warning, continue with remaining models)
- NFR4: Zero P0 or P1 bugs at initial release, where P0 = documentation generation fails for any valid Laravel model, and P1 = any supported relationship type is incorrectly detected or omitted

### Compatibility

- NFR5: The package must support PHP 8.2 and above
- NFR6: The package must support Laravel 12 and Laravel 13
- NFR7: The package must not conflict with Laravel packages with 500,000+ Packagist downloads, including Spatie packages, Laravel Debugbar, Laravel Telescope, and Pest PHP
- NFR8: Generated output must render correctly on GitHub without modification or external dependencies

### Maintainability

- NFR9: The codebase must maintain 90%+ test coverage
- NFR10: All public APIs (commands, config) must be documented in README
- NFR11: The package structure must follow Laravel package conventions for discoverability

### Integration

- NFR12: The package must register its Artisan command automatically via Laravel's service provider
- NFR13: The package must publish its configuration file via `php artisan vendor:publish`
- NFR14: The package must respect Laravel's environment configuration patterns (env variables, config caching)
