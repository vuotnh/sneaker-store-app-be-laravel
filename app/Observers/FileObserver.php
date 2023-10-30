<?php

namespace App\Observers;

use App\Models\File;

class FileObserver
{
    /**
     * Hook into file deleting event
     * @param File $file
     * @return void
     */
    public function deleting(File $file) {
        
    }
}
