<?php

namespace ElfsightInstagramFeedApi;


class Format {
    private $Api;

    public function __construct($Api) {
        $this->Api = $Api;
    }

    public function formatUser($user_data){
        return array(
            'username' => $user_data['username'],
            'profile_picture' => $user_data['profile_pic_url'],
            'id' => $user_data['id'],
            'full_name' => $user_data['full_name'],
            'counts' => array(
                'media' => $user_data['edge_owner_to_timeline_media']['count'],
                'followed_by' => $user_data['edge_followed_by']['count'],
                'follows' => $user_data['edge_follow']['count']
            )
        );
    }

    public function formatNodes($data, $type = false) {
        $formatted_data = array();
        $nodes = array();

        if (empty($data)) {
            return $this->Api->subError('no posts yet');
        }

        foreach ($data as $item) {
            $nodes[] = $item['node'];
        }

        if ($type === 'hashtag') {
            $nodes = $this->Api->Helper->uniqueSort($nodes, 'taken_at_timestamp');
        }

        foreach ($nodes as $node) {
            $formatted_data[] = $this->formatMedia($node);
        }

        return $formatted_data;
    }

    public function formatMedia($raw_data) {
        $formatted_user = !empty($this->Api->user) ? $this->Api->user : null;

        if (!empty($raw_data['owner']) && !$formatted_user) {
            $formatted_user = array(
                'id' => $raw_data['owner']['id'],
                'username' => !empty($raw_data['owner']['username']) ? $raw_data['owner']['username'] : '',
                'profile_picture' => !empty($raw_data['owner']['profile_pic_url']) ? $raw_data['owner']['profile_pic_url'] : '',
                'full_name' => !empty($raw_data['owner']['full_name']) ? $raw_data['owner']['full_name'] : ''
            );
        }

        $image_ratio = $raw_data['dimensions']['height'] / $raw_data['dimensions']['width'];

        $formatted_item = array(
            'attribution' => null,
            'video_url' => !empty($raw_data['video_url']) ? $raw_data['video_url'] : null,
            'tags' => null,
            'location' => null,
            'comments' => null,
            'filter' => !empty($raw_data['filter_name']) ? $raw_data['filter_name'] : null,
            'created_time' => !empty($raw_data['date']) ? $raw_data['date'] : $raw_data['taken_at_timestamp'],
            'link' => 'https://www.instagram.com/p/' . (!empty($raw_data['code']) ? $raw_data['code'] : $raw_data['shortcode']) . '/',
            'likes' => null,
            'images' => array(
                'low_resolution' => array(
                    'url' => !empty($raw_data['thumbnail_src']) ? $raw_data['thumbnail_src'] : $this->resizeImage(!empty($raw_data['display_src']) ? $raw_data['display_src'] : $raw_data['display_url'], 320, 320),
                    'width' => 320,
                    'height' => $image_ratio * 320
                ),

                'thumbnail' => array(
                    'url' => !empty($raw_data['thumbnail_src']) ? $raw_data['thumbnail_src'] : $this->resizeImage(!empty($raw_data['display_src']) ? $raw_data['display_src'] : $raw_data['display_url'], 150, 150),
                    'width' => 150,
                    'height' => $image_ratio * 150
                ),

                'standard_resolution' => array(
                    'url' => !empty($raw_data['thumbnail_src']) ? $raw_data['thumbnail_src'] : $this->resizeImage(!empty($raw_data['display_src']) ? $raw_data['display_src'] : $raw_data['display_url'], 640, 640),
                    'width' => 640,
                    'height' => $image_ratio * 640
                ),

                '__original' => array(
                    'url' => !empty($raw_data['display_src']) ? $raw_data['display_src'] : $raw_data['display_url'],
                    'width' => $raw_data['dimensions']['width'],
                    'height' => $raw_data['dimensions']['height']
                )
            ),
            'users_in_photo' => null,
            'caption' => null,
            'type' => !empty($raw_data['is_video']) ? 'video' : (!empty($raw_data['__typename']) && $raw_data['__typename'] === 'GraphSidecar' ? 'carousel' : 'image'),
            'id' => $raw_data['id'] . '_' . $formatted_user['id'],
            'code' => !empty($raw_data['code']) ? $raw_data['code'] : $raw_data['shortcode'],
            'user' => $formatted_user
        );

        if (!empty($raw_data['display_resources'])) {
            $formatted_item['images']['thumbnail'] = array();
            $formatted_item['images']['low_resolution'] = array();

            foreach ($raw_data['display_resources'] as $thumbnail) {
                switch ($thumbnail['config_width']) {
                    case 150:
                        $formatted_item['images']['thumbnail'] = array(
                            'url' => $thumbnail['src'],
                            'width' => $thumbnail['config_width'],
                            'height' => $thumbnail['config_height']
                        );
                        break;
                    case 320:
                        $formatted_item['images']['low_resolution'] = array(
                            'url' => $thumbnail['src'],
                            'width' => $thumbnail['config_width'],
                            'height' => $thumbnail['config_height']
                        );
                        break;
                    case 640:
                        $formatted_item['images']['standard_resolution'] = array(
                            'url' => $thumbnail['src'],
                            'width' => $thumbnail['config_width'],
                            'height' => $thumbnail['config_height']
                        );
                        break;
                }
            }

            if (empty($formatted_item['images']['thumbnail'])) {
                $formatted_item['images']['thumbnail'] = $formatted_item['images']['standard_resolution'];
            }

            if (empty($formatted_item['images']['low_resolution'])) {
                $formatted_item['images']['low_resolution'] = $formatted_item['images']['standard_resolution'];
            }
        }

        if (!empty($raw_data['thumbnail_resources'])) {
            foreach ($raw_data['thumbnail_resources'] as $thumbnail) {
                switch ($thumbnail['config_width']) {
                    case 150:
                        $formatted_item['images']['thumbnail'] = array(
                            'url' => $thumbnail['src'],
                            'width' => $thumbnail['config_width'],
                            'height' => $thumbnail['config_height']
                        );
                        break;
                    case 320:
                        $formatted_item['images']['low_resolution'] = array(
                            'url' => $thumbnail['src'],
                            'width' => $thumbnail['config_width'],
                            'height' => $thumbnail['config_height']
                        );
                        break;
                    case 640:
                        $formatted_item['images']['standard_resolution'] = array(
                            'url' => $thumbnail['src'],
                            'width' => $thumbnail['config_width'],
                            'height' => $thumbnail['config_height']
                        );
                        break;
                }
            }
        }

        if (!empty($raw_data['caption'])) {
            $formatted_item['caption'] = array(
                'created_time' => $raw_data['date'],
                'text' => $raw_data['caption'],
                'from' => $formatted_user
            );

            $formatted_item['tags'] = $this->parseTags($raw_data['caption']);
        }

        if (isset($raw_data['edge_media_to_caption']['edges'][0]['node']['text'])) {
            $formatted_item['caption'] = array(
                'created_time' => $raw_data['taken_at_timestamp'],
                'text' => $raw_data['edge_media_to_caption']['edges'][0]['node']['text'],
                'from' => $formatted_user
            );

            $formatted_item['tags'] = $this->parseTags($raw_data['edge_media_to_caption']['edges'][0]['node']['text']);
        }

        if (!empty($raw_data['comments'])) {
            $formatted_item['comments'] = array(
                'count' => !empty($raw_data['comments']['count']) ? $raw_data['comments']['count'] : 0,
                'data' => array()
            );

            if (!empty($raw_data['comments']['nodes'])) {
                $comments_list = array_slice($raw_data['comments']['nodes'], -10, 10);

                foreach ($comments_list as $comment) {
                    $comment_author = null;

                    if (!empty($comment['user'])) {
                        $comment_author = array(
                            'username' => $comment['user']['username'],
                            'profile_picture' => $comment['user']['profile_pic_url'],
                            'id' => $comment['user']['id']
                        );
                    }

                    $formatted_item['comments']['data'][] = array(
                        'created_time' => $comment['created_at'],
                        'text' => $comment['text'],
                        'from' => $comment_author
                    );
                }
            }
        }

        if (!empty($raw_data['edge_media_to_parent_comment'])) {
            $formatted_item['comments'] = array(
                'count' => !empty($raw_data['edge_media_to_parent_comment']['count']) ? $raw_data['edge_media_to_parent_comment']['count'] : 0,
                'data' => array()
            );

            if (!empty($raw_data['edge_media_to_parent_comment']['edges'])) {
                $comments_list = array_slice($raw_data['edge_media_to_parent_comment']['edges'], -10, 10);

                foreach ($comments_list as $comment) {
                    $comment_author = null;

                    $comment_node = $comment['node'];

                    if (!empty($comment_node['owner'])) {
                        $comment_author = array(
                            'username' => $comment_node['owner']['username'],
                            'profile_picture' => $comment_node['owner']['profile_pic_url'],
                            'id' => $comment_node['owner']['id']
                        );
                    }

                    $formatted_item['comments']['data'][] = array(
                        'created_time' => $comment_node['created_at'],
                        'text' => $comment_node['text'],
                        'from' => $comment_author
                    );
                }
            }
        }

        if (!empty($raw_data['edge_media_to_comment'])) {
            $formatted_item['comments'] = array(
                'count' => !empty($raw_data['edge_media_to_comment']['count']) ? $raw_data['edge_media_to_comment']['count'] : 0,
                'data' => array()
            );

            if (!empty($raw_data['edge_media_to_comment']['edges'])) {
                $comments_list = array_slice($raw_data['edge_media_to_comment']['edges'], -10, 10);

                foreach ($comments_list as $comment) {
                    $comment_author = null;

                    $comment_node = $comment['node'];

                    if (!empty($comment_node['owner'])) {
                        $comment_author = array(
                            'username' => $comment_node['owner']['username'],
                            'profile_picture' => $comment_node['owner']['profile_pic_url'],
                            'id' => $comment_node['owner']['id']
                        );
                    }

                    $formatted_item['comments']['data'][] = array(
                        'created_time' => $comment_node['created_at'],
                        'text' => $comment_node['text'],
                        'from' => $comment_author
                    );
                }
            }
        }

        if (!empty($raw_data['likes'])) {
            $formatted_item['likes'] = array(
                'count' => !empty($raw_data['likes']['count']) ? $raw_data['likes']['count'] : 0,
                'data' => array()
            );

            if (!empty($raw_data['likes']['nodes'])) {
                $likes_list = array_slice($raw_data['likes']['nodes'], -4, 4);

                foreach ($likes_list as $like) {
                    $like_author = null;

                    if (!empty($like['user'])) {
                        $like_author = array(
                            'username' => $like['user']['username'],
                            'profile_picture' => $like['user']['profile_pic_url'],
                            'id' => $like['user']['id']
                        );
                    }

                    $formatted_item['likes']['data'][] = $like_author;
                }
            }
        }
        if (!empty($raw_data['edge_liked_by'])) {
            $formatted_item['likes'] = array(
                'count' => !empty($raw_data['edge_liked_by']['count']) ? $raw_data['edge_liked_by']['count'] : 0,
                'data' => array()
            );
        }

        if (!empty($raw_data['edge_media_preview_like'])) {
            $formatted_item['likes'] = array(
                'count' => !empty($raw_data['edge_media_preview_like']['count']) ? $raw_data['edge_media_preview_like']['count'] : 0,
                'data' => array()
            );

            if (!empty($raw_data['edge_media_preview_like']['edges'])) {
                $likes_list = array_slice($raw_data['edge_media_preview_like']['edges'], -4, 4);

                foreach ($likes_list as $like) {
                    $like_author = null;

                    if (!empty($like['node'])) {
                        $like_author = array(
                            'username' => $like['node']['username'],
                            'profile_picture' => $like['node']['profile_pic_url'],
                            'id' => $like['node']['id']
                        );
                    }

                    $formatted_item['likes']['data'][] = $like_author;
                }
            }
        }

        if (!empty($raw_data['location'])) {
            $formatted_item['location'] = array(
                'name' => $raw_data['location']['name'],
                'id' => $raw_data['location']['id']
            );
        }

        if (!empty($raw_data['edge_sidecar_to_children'])) {
            $formatted_item['carousel'] = array();

            foreach ($raw_data['edge_sidecar_to_children']['edges'] as $carouselItem) {
                if (!empty($carouselItem['node']['display_url'])) {
                    $carouselItem['node']['display_url'] = $this->resizeImage($carouselItem['node']['display_url'], 640, 640);
                }

                $formatted_item['carousel'][] = $carouselItem['node'];
            }
        }

        return $formatted_item;
    }

    function resizeImage($url, $width, $height) {
        if (preg_match('#/s\d+x\d+/#', $url)) {
            return preg_replace('/\/vp\//', '/', preg_replace('#/s\d+x\d+/#', '/s' . $width . 'x' . $height . '/', $url));

        } else if (preg_match('#/e\d+/#', $url)) {
            return preg_replace('/\/vp\//', '/', preg_replace('#/e(\d+)/#', '/s' . $width . 'x' . $height . '/e$1/', $url));

        } else if (preg_match('#(\.com/[^/]+)/#', $url)) {
            return preg_replace('/\/vp\//', '/', preg_replace('#(\.com/[^/]+)/#', '$1/s' . $width . 'x' . $height . '/', $url));
        }

        return null;
    }

    function parseTags($text) {
        preg_match_all('#\#([\w_]+)#u', $text, $tagsMatches);

        return $tagsMatches[1];
    }
}
