<?php


/**
 * @param $id
 * @return \App\User
 */
function getUserDate($id){
	/** @var \App\User $user */
	$user = \App\User::whereId($id)->first();
	return $user;
}

/**
 * @param $version
 * @param null $parent_id
 */
function createTree($version, $parent_id=null)
{
    $folders = \App\Models\Folder::where('version_id', $version)->where('parent_id', $parent_id)->get();

    foreach ($folders as $folder){

        $id = $folder->id;
        $title = $folder->title;

        if ($parent_id == null)
            echo '<li><span><i class="fa fa-minus"></i> '.$title.'</span> 
                  <button class="btn btn-sm btn-secondary folder" data-id="'.$id.'" data-title="Child Folder For '.$title.'"
                  data-toggle="modal" data-target="#folderModal"><i class="fa fa-plus"></i> F</button>
                  <button class="btn btn-sm btn-secondary route" data-id="'.$id.'" data-title="Create Route In '.$title.'"
                  data-toggle="modal" data-target="#routeModal"><i class="fa fa-plus"></i> R</button>
                  <a href="/folder/destroy/'.$id.'" class="btn btn-sm btn-secondary"><i class="fa fa-trash"></i></a>';

        else if($folder->getChildFolder()->count() == 0){
            echo '<li><span><i class="fa fa-minus"></i> '.$title.'</span> 
                  <button class="btn btn-sm btn-secondary folder" data-id="'.$id.'" data-title="Child Folder For '.$title.'"
                  data-toggle="modal" data-target="#folderModal"><i class="fa fa-plus"></i> F</button>
                  <button class="btn btn-sm btn-secondary route" data-id="'.$id.'" data-title="Create Route In '.$title.'"
                  data-toggle="modal" data-target="#routeModal"><i class="fa fa-plus"></i> R</button>
                  <a href="/folder/destroy/'.$id.'" class="btn btn-sm btn-secondary"><i class="fa fa-trash"></i></a>';
            createRoute($id);
            echo '</li>';

        }

        if ($folder->getChildFolder()->count() > 0){
            echo '<ul>';
            createTree($version, $id);
            createRoute($id, true);
            echo '</ul>';
        }

        echo '</li>';
    }

}

function createRoute($folder_id, $root=false){
    $routes = \App\Models\Route::whereFolderId($folder_id)->get();
    if ($routes){
        if ($root == false)
            echo '<ul>';
        foreach ($routes as $route){
            echo '<li><a href="'.route('routes.details.ver', ['route'=>$route->id]).'"><span><span class="badge badge-primary hvr-bounce-in">'.strtoupper($route->method).'</span> <i class="fa fa-leaf"></i> '.$route->uri.'</span></a></li>';
        }
        if ($root == false)
            echo '</ul>';
    }
}
