<div class="flex flex-wrap gap-3 mb-12" data-aos="fade-up">
    <template x-for="btn in filters" :key="btn.value">
        <button
            type="button"
            @click="setFilter(btn.value)"
            class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 border outline-none"
            :class="active === btn.value
                ? 'bg-pinkCreamy dark:bg-gold text-white dark:text-black border-transparent shadow-lg shadow-pinkCreamy/30 dark:shadow-gold/20'
                : 'bg-white dark:bg-[#1a1a1a] text-gray-400 dark:text-white/50 border-gray-100 dark:border-white/5 hover:border-pinkCreamy dark:hover:border-white/20 hover:text-pinkCreamy dark:hover:text-white'"
        >
            <span x-text="btn.label"></span>
        </button>
    </template>
</div>