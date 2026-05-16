<?php
declare(strict_types=1);
namespace App\Web\Feedback;

use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Required;

final class FeedbackData
{
    #[Required]
    #[Length(min: 2, max: 100, skipOnEmpty: true)]
    public ?string $name = '';

    #[Required]
    #[Email(skipOnEmpty: true)]
    public ?string $email = '';

    #[Required]
    #[Length(min: 10, max: 1000, skipOnEmpty: true)]
    public ?string $message = '';
}