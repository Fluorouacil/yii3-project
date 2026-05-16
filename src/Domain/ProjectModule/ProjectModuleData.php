<?php
declare(strict_types=1);

namespace App\Domain\ProjectModule;

use Yiisoft\Validator\Rule\In;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\Rule\Required;

final class ProjectModuleData
{
    #[Required]
    #[Length(min: 2, max: 120, skipOnEmpty: true)]
    public ?string $title = '';

    #[Length(min: 0, max: 1000)]
    public ?string $description = '';

    #[Required]
    #[In(['new', 'active', 'done'], skipOnEmpty: true)]
    public ?string $status = 'new';

    #[Required]
    #[Number(min: 0, max: 10000, skipOnEmpty: true)]
    public int|string|null $sort = 0;
}