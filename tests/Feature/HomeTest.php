<?php

namespace Tests\Feature;
use Tests\TestCase;

class HomeTest extends TestCase
{
    
    // For home testing alwasys start with test_
    public function test_Home()
    {
        $response = $this->get('/');
        $response->assertSeeText('HELLO');
        
    }

    // For contact testing always start with test
    public function test_forContact(){
       $contactresponse = $this->get('/contact');
       $contactresponse->assertSeeText('Page'); 
    }
}
