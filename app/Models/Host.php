<?php

namespace App\Models;

use ArtARTs36\EnvEditor\Editor;
use ArtARTs36\EnvEditor\Env;
use ArtARTs36\GitHandler\Action;
use ArtARTs36\GitHandler\Git;
use ArtARTs36\HostReviewerCore\Entities\Domain;
use ArtARTs36\HostReviewerCore\Entities\RemoteGit;
use Illuminate\Database\Eloquent\Model;
use ArtARTs36\HostReviewerCore\Entities\Host as Entity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $domain
 * @property string $git_branch
 * @property string $include_script_path
 * @property int $access_strategy
 * @property string $path
 * @property Project $project
 * @property int $type_id
 * @property HostType $type
 */
class Host extends Model
{
    public const FIELD_NAME = 'name';
    public const FIELD_DOMAIN = 'domain';
    public const FIELD_GIT_BRANCH = 'git_branch';
    public const FIELD_INCLUDE_SCRIPT = 'include_script_path';
    public const FIELD_ACCESS_STRATEGY = 'access_strategy';
    public const FIELD_PATH = 'path';
    public const FIELD_PROJECT_ID = 'project_id';
    public const FIELD_TYPE_ID = 'type_id';

    public const RELATION_IPS = 'ips';
    public const RELATION_PROJECT = 'project';
    public const RELATION_TYPE = 'type';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_DOMAIN,
        self::FIELD_GIT_BRANCH,
        self::FIELD_PATH,
        self::FIELD_PROJECT_ID,
        self::FIELD_TYPE_ID,
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(HostType::class);
    }

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return HasMany
     */
    public function ips(): HasMany
    {
        return $this->hasMany(Ip::class);
    }

    public function cache(): void
    {
        file_put_contents($this->getCachePath(), $this->toJson());
    }

    /**
     * @return string
     */
    public function getCachePath(): string
    {
        return storage_path('hosts/'. $this->id . '.json');
    }

    /**
     * @return Entity
     */
    public function toEntity(): Entity
    {
        return new Entity(
            new RemoteGit($this->project->remote_git, $this->git_branch),
            new Domain($this->domain),
            'all_allowed',
        );
    }

    /**
     * @return Git
     */
    public function createGit(): Git
    {
        return new Git($this->path);
    }

    /**
     * @return Env
     */
    public function envFile(): Env
    {
        return Editor::load($this->getEnvPath());
    }

    /**
     * @return string
     */
    public function getEnvPath(): string
    {
        return $this->path . '/.env';
    }

    /**
     * @return bool
     */
    public function envExists(): bool
    {
        return file_exists($this->getEnvPath());
    }

    /**
     * @return Action
     */
    public function createGitAction(): Action
    {
        return new Action($this->createGit());
    }
}
