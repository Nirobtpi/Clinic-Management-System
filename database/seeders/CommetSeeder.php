<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comment=[
            ['comment'=>'This is a great clinic with excellent staff.'],
            ['comment'=>'I had a wonderful experience with my doctor here.'],
            ['comment'=>'The facilities are clean and well-maintained.'],
            ['comment'=>'Highly recommend this clinic for anyone in need of medical care.'],
            ['comment'=>'The appointment process was smooth and efficient.'],
            ['comment'=>'The staff were friendly and attentive.'],
            ['comment'=>'I felt comfortable and well-cared for during my visit.'],
            ['comment'=>'The clinic offers a wide range of services.'],
            ['comment'=>'The doctors are knowledgeable and professional.'],
            ['comment'=>'I appreciate the personalized care I received here.'],
            ['comment'=>'The clinic is located in a convenient location.'],
            ['comment'=>'The waiting time was minimal, which I appreciated.'],
            ['comment'=>'The clinic uses modern technology for treatments.'],
            ['comment'=>'The staff took the time to answer all my questions.'],
            ['comment'=>'I felt valued as a patient at this clinic.'],
            ['comment'=>'The clinic has a warm and welcoming atmosphere.'],
            ['comment'=>'I am grateful for the excellent care I received.'],
            ['comment'=>'The clinic is well-organized and efficient.'],
            ['comment'=>'The doctors are compassionate and understanding.'],
            ['comment'=>'I would definitely return to this clinic for future care.'],
            ['comment'=>'The staff went above and beyond to make my experience enjoyable.'],
            ['comment'=>'The clinic offers flexible appointment scheduling.'],
            ['comment'=>'The staff were professional and courteous.'],
            ['comment'=>'I felt confident in the care I received at this clinic.'],
            ['comment'=>'The clinic provides comprehensive medical services.'],
            ['comment'=>'The doctors take a holistic approach to patient care.'],
            ['comment'=>'I appreciate the emphasis on preventive care at this clinic.'],
            ['comment'=>'The clinic has a friendly and supportive environment.'],
            ['comment'=>'The staff were attentive to my needs throughout my visit.'],
            ['comment'=>'I felt comfortable discussing my health concerns with my doctor.'],
            ['comment'=>'The clinic is committed to providing high-quality care.'],
            ['comment'=>'The doctors are skilled and compassionate.'],
        ];
        foreach ($comment as $key => $value) {
            \App\Models\Comment::create([
                'comment'=>$value['comment'],
            ]);
        }
    }
}
