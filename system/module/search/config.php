<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->search = new stdclass();

$config->search->fields = new stdclass();
$config->search->fields->article = new stdclass();
$config->search->fields->article->id         = 'id';
$config->search->fields->article->title      = 'title';
$config->search->fields->article->content    = 'summary,content,keywords';
$config->search->fields->article->status     = 'status';
$config->search->fields->article->addedDate  = 'addedDate';
$config->search->fields->article->editedDate = 'editedDate';
$config->search->fields->article->params     = 'category,alias';

$config->search->fields->blog = $config->search->fields->article;
$config->search->fields->page = $config->search->fields->article;

$config->search->fields->product = new stdclass();
$config->search->fields->product->id         = 'id';
$config->search->fields->product->title      = 'name';
$config->search->fields->product->content    = 'desc,content,keywords,attributes';
$config->search->fields->product->status     = 'status';
$config->search->fields->product->addedDate  = 'addedDate';
$config->search->fields->product->editedDate = 'editedDate';
$config->search->fields->product->params     = 'category,alias';

$config->search->fields->thread = new stdclass();
$config->search->fields->thread->id         = 'id';
$config->search->fields->thread->title      = 'title';
$config->search->fields->thread->content    = 'content';
$config->search->fields->thread->status     = 'status';
$config->search->fields->thread->addedDate  = 'addedDate';
$config->search->fields->thread->editedDate = 'editedDate';
$config->search->fields->thread->params     = '';

$config->search->fields->book = new stdclass();
$config->search->fields->book->id         = 'id';
$config->search->fields->book->title      = 'title';
$config->search->fields->book->content    = 'summary,content,keywords';
$config->search->fields->book->status     = 'status';
$config->search->fields->book->addedDate  = 'addedDate';
$config->search->fields->book->editedDate = 'editedDate';
$config->search->fields->book->params     = 'book,alias';

/* Set the recPerPage of search. */
$config->search->recPerPage = 10;

/* Set the length of summary of search results. */
$config->search->summaryLength = 120;
