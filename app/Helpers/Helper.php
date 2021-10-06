<?php

function joinDictionary($item, $class)
{
    $instance = new $class;
    $locales = $instance->getLocales();
    $table = $instance->getTable();

    foreach ($locales as $locale) {
        $column = \Yasaie\Dictionary\Dictionary::select(["value as {$locale}", "context_id as {$locale}_context_id"])
            ->where('language_id', app()->getLocale())
            ->where('context_type', $class)
            ->where('key', $locale);

        $item->leftJoinSub($column, $locale, "{$locale}_context_id",  "{$table}.id");
    }

    return $item;
}

function repeatRelation($relation, $count)
{
    return implode('.', array_fill(0, $count, $relation));
}

function uploadMedia($item, $requests, string $collection)
{
    $requests = is_array($requests)
        ? $requests
        : explode(',', $requests);

    /** @var \App\User $user */
    $user = \Auth::user();

    foreach ($requests as $r) {
        /** @var \Spatie\MediaLibrary\Models\Media $file */
        $file = $user->media()->find($r);
        if ($file) {
            $file->move($item, $collection);
        }
    }
}
