<?php

namespace Platform\Repositories;

use Template;


class TemplateRepository extends EloquentRepository {
    protected $model;
    /**
     * @param Template $model
     */
    function __construct(Template $model)
    {
        $this->model = $model;
    }

    public function getbyUID($uid)
    {
        return Template::where('uid','=',$uid);
    }
    public function getByOwner($id)
    {

        // todo: Move 15 to config file
        return Template::where('user_id','=',$id)->where('is_deleted','=', 0)->orderBy('created_at', 'DESC')->paginate(10)->getCollection()->toArray();
    }
    public function transformAll($templates){
        return array_map(function($template){
               // $clean = json_decode($s['data']);
                if($template['visiblity'] == Template::$visiblity_private){
                    $v = "Private";
                }
                elseif($template['visiblity'] == Template::$visiblity_public){
                    $v = "Public";
                }

                if($template['approval_required'] == Template::$approval_required_false)
                    $a = "Not Required";

                if($template['approval_required'] == Template::$approval_required_true)
                    $a = "Required";


                return
                    [
                        'id' => $template['id'],
                        'uid' => $template['uid'],
                        'name' => $template['name'],
                        'style_ref' => $template['style_ref'],
                        'visiblity' => $v,
                        'version' => $template['version'],
                        'approval_required' => $a,
                        'last_updated' => ui_helper_ago( $template['updated_at']),
                    ];
            }, $templates);



    }
}
