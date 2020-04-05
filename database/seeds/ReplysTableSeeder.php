<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();
        // 所有话题 ID 数组，如：[1,2,3,4]
        $topic_ids =  \App\Models\Topic::all()->pluck('id')->toArray();
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)->times(50)->make()->each(function ($reply, $index)use($user_ids,$topic_ids, $faker) {
            // 从用户 ID 数组中随机取出一个并赋值
            $reply->user_id = $faker->randomElement($user_ids);
            // 话题 ID，同上
            $reply->topic_id = $faker->randomElement($topic_ids);
        });

        Reply::insert($replys->toArray());
    }

}
