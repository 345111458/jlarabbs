<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug'
    ];




    public function user(){

        return $this->belongsTo(User::class);
    }



    public function category(){


        return $this->belongsTo(category::class);
    }


    public function scopeWithOrder($quest,$order){

        switch($order){
            case 'recent':
                $quest->recent();
                break;

            default:
                $quest->recentReplied();
                break;

        }

        // 预加载防止 N+1 问题
        return $quest->with('user','category');
    }


    public function scopeRecentReplied($quest){


        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $quest->orderBy('updated_at','desc');
    }

    public function scopeRecent($quest){

        // 按照创建时间排序
        return $quest->orderBy('created_at','desc');
    }














}
