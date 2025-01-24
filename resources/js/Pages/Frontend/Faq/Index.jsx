import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import UserMenu from '@/Layouts/UserMenu';
import { useState } from 'react';
import axios from 'axios';

export default function UpdateProfileInformation({ faqs }) {
  const auth = usePage().props.auth;
  console.log('faqs', faqs);
  return (<UserMenu auth={auth} activeTab={'faq'}>

    <div
      className="tab-pane fade show active"
      id="pills-fifth"
      role="tabpanel"
      aria-labelledby="pills-fifth-tab"
    >
      <div className="account-right-content">
        <div className="details-heading px-4 py-3">
          <h3>Need Help?</h3>
        </div>
        <div className="contact_details p-4 need-help">
          <div className="accordion" id="accordionExample">
            {faqs.filter(faq => faq.visibility === 1) // Filter FAQs based on visibility
              .sort((a, b) => a.sort_order - b.sort_order) // Sort FAQs by sort_order
              .map(faq =>
                <div className="accordion-item">
                  <h2 className="accordion-header">
                    <button
                      className="accordion-button collapsed"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target={"#collapse" + faq.faq_id}
                      aria-expanded="true"
                      aria-controls={"collapse" + faq.faq_id}
                    >
                      <span>{faq.faq_name}</span> <br />
                      <p>
                        {faq.sub_title}
                      </p>
                    </button>
                  </h2>
                  <div
                    id={"collapse" + faq.faq_id}
                    className="accordion-collapse collapse"
                    data-bs-parent="#accordionExample"
                  >
                    <div className="accordion-body">
                      {faq.questions.map((question) => {
                        if (question.visibility == 1) {
                          return(
                          <div className="accoridan-in-box mb-4">
                            <h4>{question.fa_question}</h4>
                            <p dangerouslySetInnerHTML={{ __html: question.fa_question_ans }}>

                            </p>
                          </div>)
                        }

                      }
                      )}

                    </div>
                  </div>
                </div>
              )}

          </div>
        </div>
      </div>
    </div>
  </UserMenu>);
}





