/*
 |--------------------------------------------------------------------------
 | IntactFX Core App
 |--------------------------------------------------------------------------
 | Author: Mark & Dan
 | Email: marktableza@gmail.com & -- Dan please insert your email here --
 | 
 | Inspired by: Laravel Spark (https://github.com/laravel/spark/)
 | 
 */

require('./core/bootstrap');

window.vm = new Vue(require('./intactfx'));

window.vm.tweet_feeds = [ { text : 'fsdfsf' } ];