<?php

add_filter('stm_wpcfto_boxes', function ($boxes) {

    $data_boxes = array(
        'stm_courses_curriculum' => array(
            'post_type' => array('stm-courses'),
            'label' => esc_html__('Course curriculum', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_courses_settings' => array(
            'post_type' => array('stm-courses'),
            'label' => esc_html__('Course Settings', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_lesson_settings' => array(
            'post_type' => array('stm-lessons'),
            'label' => esc_html__('Lesson Settings', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_quiz_questions' => array(
            'post_type' => array('stm-quizzes'),
            'label' => esc_html__('Quiz Questions', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_quiz_settings' => array(
            'post_type' => array('stm-quizzes'),
            'label' => esc_html__('Quiz Settings', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_question_settings' => array(
            'post_type' => array('stm-questions'),
            'label' => esc_html__('Question Settings', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_reviews' => array(
            'post_type' => array('stm-reviews'),
            'label' => esc_html__('Review info', 'masterstudy-lms-learning-management-system'),
        ),
        'stm_order_info' => array(
            'post_type' => array('stm-orders'),
            'label' => esc_html__('Order info', 'masterstudy-lms-learning-management-system'),
            'skip_post_type' => 1
        ),
    );

    $boxes = array_merge($data_boxes, $boxes);

    return $boxes;
});

add_filter('stm_wpcfto_fields', function ($fields) {

    $users = STM_Metaboxes::get_users();

    $currency = STM_LMS_Helpers::get_currency();

    $courses = (class_exists('STM_LMS_Settings')) ? STM_LMS_Settings::stm_get_post_type_array('stm-courses') : array();

    $data_fields = array(
        'stm_courses_curriculum' => array(
            'section_curriculum' => array(
                'name' => esc_html__('Curriculum', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'curriculum' => array(
                        'type' => 'curriculum',
                        'post_type' => apply_filters('stm_lms_curriculum_post_types', array('stm-lessons', 'stm-quizzes', 'stm-assignments')),
                        'sanitize' => 'stm_lms_sanitize_curriculum'
                    ),
                )
            )
        ),
        'stm_courses_settings' => array(
            'section_settings' => array(
                'name' => esc_html__('Settings', 'masterstudy-lms-learning-management-system'),
                'label' => esc_html__('General Settings', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-cog',
                'fields' => array(
                    'featured' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Featured Course', 'masterstudy-lms-learning-management-system'),
                        'hint' => esc_html__('Mark this checkbox to add badge to course "Featured".', 'masterstudy-lms-learning-management-system'),
                    ),
                    'views' => array(
                        'type' => 'number',
                        'label' => esc_html__('Course Views', 'masterstudy-lms-learning-management-system'),
                        'sanitize' => 'stm_lms_save_number',
                        'hint' => esc_html__('Field increments automatically when somebody views the course. But you can set certain amount of views.', 'masterstudy-lms-learning-management-system'),
                    ),
                    'level' => array(
                        'type' => 'select',
                        'label' => esc_html__('Course Level', 'masterstudy-lms-learning-management-system'),
                        'options' => array(
                            '' => esc_html__('Select level', 'masterstudy-lms-learning-management-system'),
                            'beginner' => esc_html__('Beginner', 'masterstudy-lms-learning-management-system'),
                            'intermediate' => esc_html__('Intermediate', 'masterstudy-lms-learning-management-system'),
                            'advanced' => esc_html__('Advanced', 'masterstudy-lms-learning-management-system'),
                        )
                    ),
                    'current_students' => array(
                        'type' => 'number',
                        'label' => esc_html__('Current students', 'masterstudy-lms-learning-management-system'),
                        'sanitize' => 'stm_lms_save_number'
                    ),
                    'duration_info' => array(
                        'type' => 'text',
                        'label' => esc_html__('Duration info', 'masterstudy-lms-learning-management-system'),
                    ),
                    'video_duration' => array(
                        'type' => 'text',
                        'label' => esc_html__('Video Duration', 'masterstudy-lms-learning-management-system'),
                    ),
                    'status' => array(
                        'group' => 'started',
                        'type' => 'radio',
                        'label' => esc_html__('Status', 'masterstudy-lms-learning-management-system'),
                        'options' => array(
                            '' => esc_html__('No status', 'masterstudy-lms-learning-management-system'),
                            'hot' => esc_html__('Hot', 'masterstudy-lms-learning-management-system'),
                            'new' => esc_html__('New', 'masterstudy-lms-learning-management-system'),
                            'special' => esc_html__('Special', 'masterstudy-lms-learning-management-system'),
                        )
                    ),
                    'status_dates' => array(
                        'group' => 'ended',
                        'type' => 'dates',
                        'label' => esc_html__('Status Dates', 'masterstudy-lms-learning-management-system'),
                        'sanitize' => 'stm_lms_save_dates',
                        'dependency' => array(
                            'key' => 'status',
                            'value' => 'not_empty'
                        )
                    ),
                )
            ),
            'section_accessibility' => array(
                'name' => esc_html__('Course Price', 'masterstudy-lms-learning-management-system'),
                'label' => esc_html__('Accessibility', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-dollar-sign',
                'fields' => array(

                    /*GROUP STARTED*/
                    'not_single_sale' => array(
                        'group' => 'started',
                        'type' => 'checkbox',
                        'label' => esc_html__('One-time purchase', 'masterstudy-lms-learning-management-system'),
                        'hint' => esc_html__('Disable one time purchase to make course available only from subscription plans. Also, you can make course free by leaving price field empty', 'masterstudy-lms-learning-management-system'),
                    ),
                    'price' => array(
                        'type' => 'number',
                        'label' => sprintf(esc_html__('Price (%s)', 'masterstudy-lms-learning-management-system'), $currency),
                        'placeholder' => sprintf(esc_html__('Leave empty if course is free', 'masterstudy-lms-learning-management-system'), $currency),
                        'sanitize' => 'stm_lms_save_number',
                        'step' => '0.01',
                        'columns' => 50,
                        'dependency' => array(
                            'key' => 'not_single_sale',
                            'value' => 'empty'
                        ),
                    ),
                    'sale_price' => array(
                        'type' => 'number',
                        'label' => sprintf(esc_html__('Sale Price (%s)', 'masterstudy-lms-learning-management-system'), $currency),
                        'placeholder' => sprintf(esc_html__('Leave empty if no sale price', 'masterstudy-lms-learning-management-system'), $currency),
                        'sanitize' => 'stm_lms_save_number',
                        'step' => '0.01',
                        'columns' => 50,
                        'dependency' => array(
                            'key' => 'not_single_sale',
                            'value' => 'empty'
                        ),
                    ),
                    'sale_price_dates' => array(
                        'group' => 'ended',
                        'type' => 'dates',
                        'label' => esc_html__('Sale Price Dates', 'masterstudy-lms-learning-management-system'),
                        'sanitize' => 'stm_lms_save_dates',
                        'dependency' => array(
                            'key' => 'sale_price',
                            'value' => 'not_empty'
                        ),
                        'pro' => true,
                    ),
                    /*GROUP ENDED*/

                    'enterprise_price' => array(
                        'pre_open' => true,
                        'type' => 'number',
                        'label' => sprintf(esc_html__('Enterprise Price (%s)', 'masterstudy-lms-learning-management-system'), $currency),
                        'hint' => sprintf(esc_html__('Price for group. Leave empty to disable group purchase', 'masterstudy-lms-learning-management-system'), $currency),
                        'pro' => true,
                    ),

                    'not_membership' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Not included in membership', 'masterstudy-lms-learning-management-system'),
                    ),
                    'affiliate_course' => array(
                        'group' => 'started',
                        'type' => 'checkbox',
                        'label' => esc_html__('Affiliate course', 'masterstudy-lms-learning-management-system'),
                        'pro' => true,
                    ),
                    'affiliate_course_text' => array(
                        'type' => 'text',
                        'label' => esc_html__('Button Text', 'masterstudy-lms-learning-management-system'),
                        'dependency' => array(
                            'key' => 'affiliate_course',
                            'value' => 'not_empty'
                        ),
                        'columns' => 50,
                        'pro' => true,
                    ),
                    'affiliate_course_link' => array(
                        'group' => 'ended',
                        'type' => 'text',
                        'label' => esc_html__('Button Link', 'masterstudy-lms-learning-management-system'),
                        'dependency' => array(
                            'key' => 'affiliate_course',
                            'value' => 'not_empty'
                        ),
                        'columns' => 50,
                        'pro' => true,
                    ),
                )
            ),
            'section_drip_content' => array(
                'name' => esc_html__('Content Drip', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-list',
                'fields' => array(
                    'drip_content' => array(
                        'type' => 'drip_content',
                        'post_type' => array( 'stm-lessons', 'stm-quizzes' ),
                        'label' => esc_html__( 'Sequential Drip Content', 'masterstudy-lms-learning-management-system-pro' ),
                        'pro' => true
                    ),
                )
            ),
            'section_prereqs' => array(
                'name' => esc_html__('Prerequisites', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-flag-checkered',
                'fields' => array(
                    'prerequisites' => array(
                        'type' => 'autocomplete',
                        'post_type' => array('stm-courses'),
                        'label' => esc_html__('Prerequisite Courses', 'masterstudy-lms-learning-management-system-pro'),
                        'pro' => true,
                    ),
                    'prerequisite_passing_level' => array(
                        'type' => 'text',
                        'classes' => array('short_field'),
                        'placeholder' => esc_html__('Percent (%)', 'masterstudy-lms-learning-management-system-pro'),
                        'label' => esc_html__('Prerequisite Passing Percent (%)', 'masterstudy-lms-learning-management-system-pro'),
                        'pro' => true,
                    ),
                ),
            ),
            'section_announcement' => array(
                'name' => esc_html__('Announcement', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-bullhorn',
                'fields' => array(
                    'announcement' => array(
                        'type' => 'editor',
                        'label' => esc_html__('Announcement', 'masterstudy-lms-learning-management-system'),
                    ),
                )
            ),
            'section_faq' => array(
                'name' => esc_html__('FAQ', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-question',
                'fields' => array(
                    'faq' => array(
                        'type' => 'faq',
                        'label' => esc_html__('FAQ', 'masterstudy-lms-learning-management-system'),
                    ),
                )
            ),
            'section_files' => array(
                'name' => esc_html__('Course files', 'masterstudy-lms-learning-management-system'),
                'icon' => 'fa fa-download',
                'fields' => array(
                    'course_files_pack' => stm_lms_course_files_data()
                )
            )
        ),
        'stm_lesson_settings' => array(
            'section_lesson_settings' => array(
                'name' => esc_html__('Lesson Settings', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'type' => array(
                        'type' => 'select',
                        'label' => esc_html__('Lesson type', 'masterstudy-lms-learning-management-system'),
                        'options' => array(
                            'text' => esc_html__('Text', 'masterstudy-lms-learning-management-system'),
                            'video' => esc_html__('Video', 'masterstudy-lms-learning-management-system'),
                            'slide' => esc_html__('Slide', 'masterstudy-lms-learning-management-system'),
                        ),
                        'value' => 'text'
                    ),
                    'duration' => array(
                        'type' => 'text',
                        'label' => esc_html__('Lesson duration', 'masterstudy-lms-learning-management-system'),
                    ),
                    'preview' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Lesson preview (Lesson will be available to everyone)', 'masterstudy-lms-learning-management-system'),
                    ),
                    'lesson_excerpt' => array(
                        'type' => 'editor',
                        'label' => esc_html__('Lesson Frontend description', 'masterstudy-lms-learning-management-system'),
                    ),
                    'lesson_video_poster' => array(
                        'type' => 'image',
                        'label' => esc_html__('Lesson video poster', 'masterstudy-lms-learning-management-system'),
                    ),
                    'lesson_video_url' => array(
                        'type' => 'text',
                        'label' => esc_html__('Lesson video URL', 'masterstudy-lms-learning-management-system'),
                    ),
                    'lesson_video' => array(
                        'type' => 'image',
                        'label' => esc_html__('Lesson video', 'masterstudy-lms-learning-management-system'),
                        'dependency' => array(
                            'key' => 'type',
                            'value' => 'video'
                        )
                    ),
                    'lesson_files_pack' => stm_lms_lesson_files_data()
                )
            )
        ),
        'stm_quiz_questions' => array(
            'section_questions' => array(
                'name' => esc_html__('Questions', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'questions' => array(
                        'type' => 'questions_v2',
                        'label' => esc_html__('Questions', 'masterstudy-lms-learning-management-system'),
                        'post_type' => array('stm-questions')
                    ),
                )
            )
        ),
        'stm_quiz_settings' => array(
            'section_quiz_settings' => array(
                'name' => esc_html__('Quiz Settings', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'lesson_excerpt' => array(
                        'type' => 'editor',
                        'label' => esc_html__('Quiz Frontend description', 'masterstudy-lms-learning-management-system'),
                    ),
                    'duration' => array(
                        'type' => 'duration',
                        'label' => esc_html__('Quiz duration', 'masterstudy-lms-learning-management-system'),
                    ),
                    'duration_measure' => array(
                        'type' => 'not_exist',
                    ),
                    'correct_answer' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Show correct answer', 'masterstudy-lms-learning-management-system'),
                    ),
                    'passing_grade' => array(
                        'type' => 'number',
                        'label' => esc_html__('Passing grade (%)', 'masterstudy-lms-learning-management-system'),
                    ),
                    're_take_cut' => array(
                        'type' => 'number',
                        'label' => esc_html__('Points total cut after re-take (%)', 'masterstudy-lms-learning-management-system'),
                    ),
                    'random_questions' => array(
                        'type' => 'checkbox',
                        'label' => esc_html__('Randomize questions', 'masterstudy-lms-learning-management-system'),
                    ),
                )
            )
        ),
        'stm_question_settings' => array(
            'section_question_settings' => array(
                'name' => esc_html__('Question Settings', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'type' => array(
                        'type' => 'select',
                        'label' => esc_html__('Question type', 'masterstudy-lms-learning-management-system'),
                        'options' => array(
                            'single_choice' => esc_html__('Single choice', 'masterstudy-lms-learning-management-system'),
                            'multi_choice' => esc_html__('Multi choice', 'masterstudy-lms-learning-management-system'),
                            'true_false' => esc_html__('True or False', 'masterstudy-lms-learning-management-system'),
                            'item_match' => esc_html__('Item Match', 'masterstudy-lms-learning-management-system'),
                            'keywords' => esc_html__('Keywords', 'masterstudy-lms-learning-management-system'),
                            'fill_the_gap' => esc_html__('Fill the Gap', 'masterstudy-lms-learning-management-system'),
                        ),
                        'value' => 'single_choice'
                    ),
                    'answers' => array(
                        'type' => 'answers',
                        'label' => esc_html__('Answers', 'masterstudy-lms-learning-management-system'),
                        'requirements' => 'type'
                    ),
                    'question_explanation' => array(
                        'type' => 'textarea',
                        'label' => esc_html__('Question result explanation', 'masterstudy-lms-learning-management-system'),
                    ),
                )
            )
        ),
        'stm_reviews' => array(
            'section_data' => array(
                'name' => esc_html__('Review info', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'review_course' => array(
                        'type' => 'select',
                        'label' => esc_html__('Course Reviewed', 'masterstudy-lms-learning-management-system'),
                        'options' => $courses,
                    ),
                    'review_user' => array(
                        'type' => 'select',
                        'label' => esc_html__('User Reviewed', 'masterstudy-lms-learning-management-system'),
                        'options' => $users,
                    ),
                    'review_mark' => array(
                        'type' => 'select',
                        'label' => esc_html__('User Review mark', 'masterstudy-lms-learning-management-system'),
                        'options' => array(
                            '5' => '5',
                            '4' => '4',
                            '3' => '3',
                            '2' => '2',
                            '1' => '1'
                        )
                    ),
                )
            )
        ),
        'stm_order_info' => array(
            'order_info' => array(
                'name' => esc_html__('Order', 'masterstudy-lms-learning-management-system'),
                'fields' => array(
                    'order' => array(
                        'type' => 'order',
                    ),
                )
            )
        ),
    );

    $fields = array_merge($data_fields, $fields);

    return $fields;
});