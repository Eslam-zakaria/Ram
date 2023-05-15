<?php

use Illuminate\Database\Seeder;
use Modules\Blog\Seeds\BlogCategorySeeder;
use Modules\Blog\Seeds\BlogSeeder;
use Modules\Comment\Seeds\CommentSeeder;
use Modules\Branche\Seeds\BrancheSeeder;
use Modules\Department\Seeds\DepartmentSeeder;
use Modules\Discount\Seeds\DiscountCategorySeeder;
use Modules\Discount\Seeds\DiscountSeeder;
use Modules\Doctor\Seeds\DoctorSeeder;
use Modules\Job\Seeds\JobSeeder;
use Modules\Offer\Seeds\OfferBrancheSeeder;
use Modules\Offer\Seeds\OfferSeeder;
use Modules\Page\Seeds\PageSeeder;
use Modules\Partner\Seeds\PartnerSeeder;
use Modules\Service\Seeds\ServiceSeeder;
use Modules\Lead\Seeds\LeadSeeder;
use Modules\Slider\Seeds\SliderSeeder;
use Modules\Specificity\Seeds\CategorySeeder;
use Modules\Specificity\Seeds\SpecificitySeeder;
use Modules\Video\Seeds\VideoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(BlogCategorySeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(OfferBrancheSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(BrancheSeeder::class);
        $this->call(LeadSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(SpecificitySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(\Modules\Discount\Seeds\CardSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(DiscountCategorySeeder::class);
        $this->call(\Modules\Casing\Seeds\CasingCategorySeeder::class);
        $this->call(\Modules\Casing\Seeds\CasingSeeder::class);
        $this->call(\Modules\Testimonial\Seeds\TestimonialSeeder::class);

    }
}
