<template>
  <main class="min-h-screen place-items-center px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center">
      <p class="text-base font-semibold text-indigo-600">500</p>
      <h1 class="mt-4 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
        Internal Server Error
      </h1>
      <p class="mt-6 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
        Sorry, we couldn’t find the page you’re looking for. Already working to solve the problem.
      </p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <RouterLink
          :to="{ name: 'login' }"
          class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >Go back home</RouterLink
        >
      </div>
    </div>
  </main>
</template>
