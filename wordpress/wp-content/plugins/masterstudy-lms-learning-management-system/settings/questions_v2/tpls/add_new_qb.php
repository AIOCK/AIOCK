<div class="add_item question_bank" v-if="tab === 'question_bank'">

    <div class="row">
        <div class="column">
            <div class="column_content">

                <h5><?php esc_html_e('Bank name *', 'masterstudy-lms-learning-management-system'); ?></h5>
                <input type="text" v-model="question_bank_title"/>

                <h5><?php esc_html_e('Available categories', 'masterstudy-lms-learning-management-system'); ?></h5>

                <div class="question_bank__categories">
                    <div class="question_bank__category"
                         @click="addToBank(term)"
                         v-for="term in question_bank">

                        <label class="stm_lms_checkbox"
                               v-bind:class="{'active' : typeof question_bank_category[term.slug] !== 'undefined'}">
                            <span v-html="term.name + ' (' + term.count + ')'"></span>
                            <i class="fa fa-check"></i>
                        </label>
                    </div>
                </div>

            </div>

        </div>
        <div class="column">

            <div class="column_content">

                <h5><?php esc_html_e('Select number of questions *', 'masterstudy-lms-learning-management-system'); ?></h5>
                <input type="number" v-model="question_bank_num"/>

                <h5><?php esc_html_e('Selected categories *', 'masterstudy-lms-learning-management-system'); ?></h5>

                <div class="selected_categories_wrapper" v-if="Object.keys(question_bank_category).length">
                    <div class="selected_categories">
                        <div class="selected_category" v-for="bank_term in question_bank_category"
                             v-if="typeof bank_term !== 'undefined'">
                            <span v-html="bank_term.name"></span>
                            <i class="fa fa-times" @click="addToBank(bank_term)"></i>
                        </div>
                    </div>

                    <a href="#" @click.prevent="addQB" class="button" v-if="question_bank_title.length">
                        <?php esc_html_e('Add question bank', 'masterstudy-lms-learning-management-system'); ?>
                    </a>

                </div>

                <h6 v-else>
                    <?php esc_html_e('No category selected yet...', 'masterstudy-lms-learning-management-system'); ?>
                </h6>

            </div>
        </div>
    </div>
</div>