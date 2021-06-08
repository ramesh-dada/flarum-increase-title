<?php

use Flarum\Extend;
use Flarum\Discussion\DiscussionValidator;
use Illuminate\Support\Str;

return [
  // Register extenders here
  (new Extend\Validator(DiscussionValidator::class))
    ->configure(function ($flarumValidator, $validator) {
        $rules = $validator->getRules();

        if (!array_key_exists('title', $rules)) {
            return;
        }

        $rules['title'] = array_map(function(string $rule) {
          if (Str::startsWith($rule, 'max:')) {
            return 'max:180';
          }
          
          return $rule;
        }, $rules['title']);

        $validator->setRules($rules);
    }),
];
