<?php
    // Store image to storage
    function storeImage($request)
    {
        $path = $request['logo']->store('images');
        $request['image_path'] = str_replace('images/', '', $path);
        $request['logo'] = $request['logo']->getClientOriginalName();
        
        return $request;
    }
?>