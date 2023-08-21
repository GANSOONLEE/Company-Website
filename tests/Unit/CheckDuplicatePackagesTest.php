<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;

class CheckDuplicatePackagesTest extends TestCase
{

    public function createApplication(){

        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }

    public function testCheckDuplicatePackages(){

        $vendorPath = base_path('vendor');
        $arrayPackages = [];
        $duplicatePackages = [];

        $packageComposerPackages = $this->getPackageComposer($vendorPath);

        foreach($packageComposerPackages as $packages){
            
            if(in_array($packages['name'], $arrayPackages)){
                $duplicatePackages[] = $packages['name'];
            }else{
                $arrayPackages[] = $packages['name'];
            }
        };


        $this->assertEmpty($duplicatePackages, '重複的套件有'. json_encode($duplicatePackages));

    }

    public function getPackageComposer($vendorPath){

        $packageComposerData = [];
        $vendorComposerArray = [];
        $vendorComposerPath = null;

        foreach(scandir($vendorPath) as $packageDir){

            if($packageDir !== '.' && $packageDir !== '..' && is_dir($vendorPath . '/' . $packageDir) && $packageDir !== 'bin'){

                // firstLayer 是不是一個目錄？
                if(is_dir($vendorPath. '/' . $packageDir)){


                    // 列出所有 firstLayer 的文件
                    foreach(scandir(($vendorPath. '/' . $packageDir)) as $file){

                        // file 是不是目錄？
                        if(is_dir($vendorPath. '/' . $packageDir . '/' . $file) && $file !== '.' && $file !== '..'){
                            
                            foreach(scandir($vendorPath. '/' . $packageDir . '/' . $file) as $file_secondary){
                                if($file_secondary === 'composer.json'){
                                    $vendorComposerPath = $vendorPath. '/' . $packageDir . '/' . $file . '/' . $file_secondary;
                                    $vendorComposerArray[] = $vendorComposerPath;
                                    // dump($vendorComposerPath);
                                }     
                            }
                        }else{
                            if($file === 'composer.json'){
                                $vendorComposerArray[] = $file;
                            }
                        }
                    }
                }
            }
        }

        

        foreach($vendorComposerArray as $vendorComposerPackage){
            $vendorComposerContents = file_get_contents($vendorComposerPackage);
            $vendorComposerData = json_decode($vendorComposerContents, true);
            $packageComposerData[] = $vendorComposerData;
        }

        return $packageComposerData;

    }
}
