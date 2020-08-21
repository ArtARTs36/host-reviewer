<?php

namespace App\Models;

use App\Concerns\Entityable;
use ArtARTs36\GitHandler\Action;
use ArtARTs36\GitHandler\Git;
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

    public const RELATION_IPS = 'ips';
    public const RELATION_PROJECT = 'project';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_DOMAIN,
        self::FIELD_GIT_BRANCH,
        self::FIELD_PATH,
        self::FIELD_PROJECT_ID,
    ];

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
            'all_allowed'
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
     * @return Action
     */
    public function createGitAction(): Action
    {
        return new Action($this->createGit());
    }
}
