<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * Register page Test
     *
     * @return void
     */
    public function testRegisterPage()
    {
        //Register admin for first time
        $this->visit("/admin/login")
             ->see("Register")
             ->type('majid@majid.com' , 'email')
             ->type('asdQWE123' , 'password')
             ->type('asdQWE123' , 'password_confirmation')
             ->press('Register')
             ->seePageIs("/");

        //must route to home because user logged in
        $this->visit("/admin/register")
             ->seePageIs("/");

        //user logout and must redirect to login page
        $this->visit("/admin/logout")
             ->seePageIs("/");

        //
        $this->visit("/admin/login")
             ->seePageIs("/admin/login");


    }

    /**
     * Login page test
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit("/admin/register")
            ->seePageIs("/admin/register")
            ->type('majid@majid.com' , 'email')
            ->type('asdQWE123' , 'password')
            ->type('asdQWE123' , 'password_confirmation')
            ->press('Register')
            ->seePageIs("/");

        $this->visit("/admin/logout")
            ->seePageIs("/");

        $this->visit("/admin/login")
             ->type("majid@majid.com" , 'email')
             ->type("asdQWE123" , 'password')
             ->press("Login")
             ->seePageIs("/");

        $this->visit("/admin/logout")
            ->seePageIs("/");

        $this->visit("/admin/login")
            ->type("Thi@not.mail" , 'email')
            ->type("asdQWE123" , 'password')
            ->press("Login")
            ->see("Error");

        $this->visit("/admin/login")
            ->press("Login")
            ->see("Error");

        $this->visit("/admin/login")
            ->type("Thi@not.mail" , 'email')
            ->press("Login")
            ->see("Error");

        $this->visit("/admin/login")
            ->type("asdQWE123" , 'password')
            ->press("Login")
            ->see("Error");

        $this->visit("/admin/login")
            ->type("majid@majid.com" , 'email')
            ->type("asadasdsad" , 'password')
            ->press("Login")
            ->see("Error");
    }

    /**
     * Test Register new motobike in dashboard page
     *
     * @return void
     */
    public function testRegisterMotobike(){
        $this->visit("/admin/register")
            ->seePageIs("/admin/register")
            ->type('majid@majid.com' , 'email')
            ->type('asdQWE123' , 'password')
            ->type('asdQWE123' , 'password_confirmation')
            ->press('Register')
            ->seePageIs("/");

        $this->visit("/")
             ->click("Register New Motobike")
             ->seePageIs("/admin/register_newbike");

        $this->visit("/admin/register_newbike")
             ->type("BMW" , "vendor_name")
             ->type("Race RT" , "model")
             ->type("october 2000" ,"produce_year")
             ->type(2000 ,"size_of_motor" )
             ->type("#ffff" , "color")
             ->type(3000 , "weight")
             ->type(4000 , "price")
             ->attach(public_path()."/motobike.jpg" , "image")
             ->press('Register')
             ->see('Motobike registered successed')
             ->see("BMW")
             ->see("october 2000")
             ->see("2000")
             ->see("3000")
             ->see("4000")
             ->see("img");

        //delete model variable
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("october 2000" ,"produce_year")
            ->type(2000 ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(2000 , "weight")
            ->type(2000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');

        //delete produce year
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type(2000 ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(2000 , "weight")
            ->type(2000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');

        //delete size of motor
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type("#ffff" , "color")
            ->type(2000 , "weight")
            ->type(2000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');

        //size of motor is string
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type("asdasdas" ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(2000 , "weight")
            ->type(2000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');

        //delete color attribute
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type(2000 ,"size_of_motor" )
            ->type(2000 , "weight")
            ->type(2000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');

        //wieght deleted
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type(2000 ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(2000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');

        //price deleted
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type(2000 ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(2000 , "weight")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Error');


        //photo deleted
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type(2000 ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(2000 , "weight")
            ->type(2000 , "price")
            ->press('Register')
            ->see('Error');
    }

    /**
     * Show all Motobike test
     *
     * @return void
     */
    public function testShowAllMotobike(){

        //register new user
        $this->visit("/admin/register")
            ->seePageIs("/admin/register")
            ->type('majid@majid.com' , 'email')
            ->type('asdQWE123' , 'password')
            ->type('asdQWE123' , 'password_confirmation')
            ->press('Register')
            ->seePageIs("/");

        //goto register new bike from dashboards
        $this->click("Register New Motobike")
            ->seePageIs("/admin/register_newbike");

        //register new bike
        $this->visit("/admin/register_newbike")
            ->type("BMW" , "vendor_name")
            ->type("Race RT" , "model")
            ->type("october 2000" ,"produce_year")
            ->type(2000 ,"size_of_motor" )
            ->type("#ffff" , "color")
            ->type(3000 , "weight")
            ->type(4000 , "price")
            ->attach(public_path()."/motobike.jpg" , "image")
            ->press('Register')
            ->see('Motobike registered successed')
            ->see("BMW")
            ->see("october 2000")
            ->see("2000")
            ->see("3000")
            ->see("4000")
            ->see("img");

        //goto show all bike from dashboard  and check wheter show registered bike or not
        $this->visit('/')
            ->see("BMW")
            ->see("2000")
            ->see("3000")
            ->see("4000")
            ->see("img");

        //goback to dashboard from allbike
        $this->visit('/admin/allbike')
            ->click('Back to Home')
            ->seePageIs('/');

        //goto create new motobike from allbike page
        $this->visit('/admin/allbike')
             ->click('Create New Motobike')
             ->seePageIs('/admin/register_newbike');

        //goto to dashboard from header link of allbike page
        $this->visit('/admin/allbike')
            ->click('Main Page')
            ->seePageIs('/');

        $this->visit('/admin/allbike')
            ->visit('admin/motobike/1')
            ->see('Motobike information')
            ->see("BMW")
            ->see("october 2000")
            ->see("october 2000")
            ->see("2000")
            ->see("3000")
            ->see("4000")
            ->see("img")
            ->click('Back')
            ->seePageIs('admin/allbike');

        $this->visit('admin/motobike/1')
             ->click('Main Page')
             ->seePageIs('/');

        $this->visit('admin/motobike/1')
            ->click('Main Page')
            ->seePageIs('/');
    }

    /**
     * Test Search Section and filter results
     *
     * @return void
     */
     public function testSearchFilter(){

         $this->visit("/admin/register")
             ->seePageIs("/admin/register")
             ->type('majid@majid.com' , 'email')
             ->type('asdQWE123' , 'password')
             ->type('asdQWE123' , 'password_confirmation')
             ->press('Register')
             ->seePageIs("/");

         //goto register new bike from dashboards
         $this->click("Register New Motobike")
             ->seePageIs("/admin/register_newbike");

         //register new bike
         $this->visit("/admin/register_newbike")
             ->type("BMW" , "vendor_name")
             ->type("Race RT" , "model")
             ->type("october 2000" ,"produce_year")
             ->type(2000 ,"size_of_motor" )
             ->type("#ffff" , "color")
             ->type(3000 , "weight")
             ->type(4000 , "price")
             ->attach(public_path()."/motobike.jpg" , "image")
             ->press('Register')
             ->see('Motobike registered successed')
             ->see("BMW")
             ->see("october 2000")
             ->see("2000")
             ->see("3000")
             ->see("4000")
             ->see("img");

         //Search form BMW key word
         $this->visit('/')
              ->type('BM*' , 'query')
              ->press('Search')
              ->see('Search Result')
              ->see('BMW');

         $this->visit('/')
             ->type('#ffff' , 'color')
             ->press('Filter By color')
             ->see('Search Result')
             ->see('BMW');

         $this->visit('/')
             ->click('Main Page')
             ->SeePageIs('/');

     }


}
