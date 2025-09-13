<script setup>
import { ref } from "vue";

// FAQ items can come from props or API, but we’ll hardcode for now
const faqs = ref([
  {
    question: "How secure is my insurance information?",
    answer:
      "We prioritize the security of your insurance information. We use advanced encryption and strict data protection measures to ensure your data is safe and confidential.",
    open: false,
  },
  {
    question: "How can I customize my insurance coverage?",
    answer:
      "Our insurance plans are customizable. You can tailor your coverage to meet your specific needs and budget.",
    open: false,
  },
  {
    question: "Is there a waiting period for insurance claims?",
    answer:
      "There may be a waiting period for certain insurance claims, depending on the policy terms and conditions. Please refer to your policy documents for details.",
    open: false,
  },
]);

const toggleFAQ = (index) => {
  faqs.value[index].open = !faqs.value[index].open;
};
</script>

<template>
  <div class="py-24 px-8 max-w-5xl mx-auto flex flex-col md:flex-row gap-12">
    <!-- Left Side -->
    <div class="flex flex-col text-left basis-1/2">
      <p class="inline-block font-semibold text-primary mb-4">Insurance FAQ</p>
      <p class="sm:text-4xl text-3xl font-extrabold text-base-content">
        Frequently Asked Questions
      </p>
    </div>

    <!-- Right Side -->
    <ul class="basis-1/2">
      <li v-for="(faq, index) in faqs" :key="index">
        <button
          class="relative flex gap-2 items-center w-full py-5 text-base font-semibold text-left border-t md:text-lg border-base-content/10"
          :aria-expanded="faq.open"
          @click="toggleFAQ(index)"
        >
          <span class="flex-1 text-base-content">{{ faq.question }}</span>
          <svg
            class="flex-shrink-0 w-4 h-4 ml-auto fill-current transition-transform duration-200"
            :class="{ 'rotate-45': faq.open }"
            viewBox="0 0 16 16"
            xmlns="http://www.w3.org/2000/svg"
          >
            <rect
              y="7"
              width="16"
              height="2"
              rx="1"
              class="transform origin-center"
            />
            <rect
              y="7"
              width="16"
              height="2"
              rx="1"
              class="transform origin-center rotate-90"
            />
          </svg>
        </button>

        <!-- Collapsible content -->
        <transition name="faq">
          <div v-show="faq.open" class="overflow-hidden">
            <div class="pb-5 leading-relaxed">
              <div class="space-y-2 leading-relaxed">
                {{ faq.answer }}
              </div>
            </div>
          </div>
        </transition>
      </li>
    </ul>
  </div>
</template>

<style scoped>
/* Transition for accordion */
.faq-enter-active,
.faq-leave-active {
  transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
}
.faq-enter-from,
.faq-leave-to {
  max-height: 0;
  opacity: 0;
}
.faq-enter-to,
.faq-leave-from {
  max-height: 500px; /* adjust if needed */
  opacity: 1;
}
</style>
