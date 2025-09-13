<script setup>
import { ref } from "vue";

// FAQ items can come from props or API, but we’ll hardcode for now
const faqs = ref([
  {
    question: "How do I know the cooks are trustworthy?",
    answer:
      "Every cook goes through a 4-step vetting process: identity check, kitchen inspection, food-safety certification, and customer reviews. You’ll see their profile, story, and specialty dishes before ordering.",
    open: false,
  },
  {
    question: "What if I don’t like my food meal?",
    answer:
      "No worries. With our Zero-Risk Guarantee, if your first order doesn’t feel like home, you get money back. Just reach out to our support team within a day of delivery.",
    open: false,
  },
  {
    question: "Can I get multiple cooks to make my meals?",
    answer:
      "Absolutely. You can mix & match meals from different cooks each week. Try new cuisines, or stick with your favorites.",
    open: false,
  },
  {
    question: "How much does it cost?",
    answer:
      "Plans start at $54 per week for 3–5 fresh, home-style meals. You can also order a single meal if you’d like to try it first.",
    open: false,
  },
 
  {
    question: "Do I have to sign a long contract?",
    answer:
      "Nope. You can order one-time meals or choose a weekly plan. Cancel or pause anytime — no hidden fees.",
    open: false,
  },
  {
    question: "How fast is delivery?",
    answer:
      "Most meals are ready by the next day. You’ll see the estimated delivery time before you confirm your order.",
    open: false,
  },
  {
    question: "Can I see who is cooking my food?",
    answer:
      "Yes. You’ll get the cook’s name, photo, story, and specialties before you order — so you always know who’s preparing your meal.",
    open: false,
  },
  {
    question: "Are the meals safe?",
    answer:
      "Absolutely. All cooks are food-safety certified, and every kitchen is inspected. Meals are sealed and delivered fresh for your peace of mind",
    open: false,
  },
  {
    question: "What payment methods do you accept?",
    answer:
      "Most meals are ready by the next day. You’ll see the estimated delivery time before you confirm your order.",
    open: false,
  },
  {
    question: "What about allergies or dietary needs?",
    answer:
      "You can filter meals by allergens, dietary restrictions, and preferences (e.g., vegetarian, halal, gluten-free). Each cook lists their ingredients clearly.",
    open: false,
  },
  {
    question: "Do you deliver everywhere?",
    answer:
      "We currently deliver in select areas. Enter your postal code at checkout to see if MyMealni is available in your location.",
    open: false,
  },
  {
    question: "What are the portion sizes like?",
    answer:
      "Meals are prepared in generous single or family-sized portions, depending on your order. Cook profiles include serving sizes so you know exactly what to expect.",
    open: false,
  },
  {
    question: "Can I leave reviews for cooks?",
    answer:
      "Yes! After your meal, you can share your experience. Reviews help keep quality high and guide other customers.",
    open: false,
  },
  
  
]);

const toggleFAQ = (index) => {
  faqs.value[index].open = !faqs.value[index].open;
};
</script>

<template>
  <div class="py-24 px-8 max-w-5xl mx-auto flex flex-col  gap-12">
    <!-- Left Side -->
    <div class="flex flex-col text-left basis-1/2">
      <p class="sm:text-5xl text-3xl font-extrabold text-center uppercase">
        FAQs
      </p>
    </div>

    <!-- Right Side -->
    <ul class="basis-1/2">
      <li v-for="(faq, index) in faqs" :key="index">
        <button
          class="relative flex gap-2 items-center w-full py-4 text-sm font-semibold text-left border-t md:text-lg border-base-content/10"
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
