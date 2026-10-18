# WebifyCMS User Extension

Package `webifycms/ext-user` (composer type `webifycms-extension`). Manages the
**user bounded context** — Identity, Authentication, and Authorization. An
extension of WebifyCMS (not a standalone app). Requires `webifycms/ext-base`.

## Layout

```
src/
  Context/{Context}/{Layer}/{Part}
  Domain/{Exception,ValueObject}   # shared kernel, below every context
  Application/                     # cross-context use cases, as they emerge
  Infrastructure/Extension/

Contexts: Identity, Authentication, Authorization
Layers:   Application, Domain, Infrastructure
Parts:    e.g. Application/{Query,Service,Strategy},
          Domain/{Collection,Entity,Event,Exception,Guard,Policy,Repository,Service,ValueObject}
```

- `Identity/`        — user identity/policies
- `Authentication/`  — login/registration, guards, strategies
- `Authorization/`   — roles, permissions, role assignment (user bounded context)
- `src/Domain/`      — shared kernel: `UserId`, `UserStatus`, `PasswordHash` and their
  exceptions. It sits below every context and must not depend on `Context`, `Application`,
  or `Infrastructure` — enforced by `test/Architecture/DomainSpecification.php`.
- `src/Infrastructure/Extension/` — the `ExtensionInterface` entry point. It spans all three
  contexts, which is why it cannot live inside any one of them.

## Conventions

- Namespace `Webify\User\*` (autoload `Webify\User\` → `src/`); tests `Webify\User\Test\` → `test/`.
- Follow Clean Architecture layering; Domain defines interfaces, Infrastructure implements them.
  Domain must not depend on Application or Infrastructure — anything that orchestrates
  repositories, event publishers, hashers, or ID generators is a use case and belongs in
  `Application`. Enforced per context by the PHPat specs in `test/Architecture/`.
- Shared-kernel value objects are consumed across contexts directly; do not re-declare a
  per-context copy.
- Extensions register themselves via the ext-base extension/service-provider contracts
  (see `extensions/ext-base/AGENTS.md`).
- A ServiceProvider bootstrap for the context lives under `src/{Context}/Infrastructure/Service/`.

## Verification

```bash
composer test          # PHPUnit
composer analyse       # PHPStan level 10 + PHPat architecture rules
composer sniff         # PHP-CS-Fixer dry-run
composer code-check    # analyse + sniff
composer code-format   # PHP-CS-Fixer fix
```