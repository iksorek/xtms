<!-- Notifications menu -->
<li class="relative">
    <button
        class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
        @click="toggleNotificationsMenu"
        @click.away="closeNotificationsMenu"
        aria-label="Notifications"
        aria-haspopup="true"
    >
        <svg
            class="w-5 h-5"
            aria-hidden="true"
            fill="currentColor"
            viewBox="0 0 20 20"
        >
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
            ></path>
        </svg>

        <!-- Notification badge -->
        @if($requstedRuns)
            <span
                aria-hidden="true"
                class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
            ></span>
        @endif


    </button>
    <template x-if="isNotificationsMenuOpen">
        <ul
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="closeNotificationsMenu"
            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
        >
            <x-dash.notification-item notification='Requested runs' :number="$requstedRuns"/>
        </ul>
    </template>
</li>
<!-- Profile menu -->
