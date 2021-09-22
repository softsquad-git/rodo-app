<?php

namespace App\Services\Newsletter;

use App\Models\Newsletter\NewsletterPost;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsletterPostService
{
    /**
     * @param array $data
     * @param NewsletterPost|null $newsletterPost
     * @return NewsletterPost
     * @throws Exception
     */
    public function save(array $data, NewsletterPost $newsletterPost = null): NewsletterPost
    {
        if ($newsletterPost) {

            return $newsletterPost;
        }

        DB::beginTransaction();
        try {
            $data['number'] = Str::random(3);
            /**
             * @var NewsletterPost $newsletterPost
             */
            $newsletterPost = NewsletterPost::create($data);

            if (!isset($data['is_all_clients']) && isset($data['client_ids']) && count($data['client_ids']) > 0) {
                $newsletterPost->clients()->sync($data['client_ids']);
            }

            DB::commit();
            return $newsletterPost;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param NewsletterPost $newsletterPost
     * @return bool|null
     */
    public function remove(NewsletterPost $newsletterPost): ?bool
    {
        return $newsletterPost->delete();
    }
}
