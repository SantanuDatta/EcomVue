<!-- components/table/BaseTable.vue -->
<template>
  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th
                  v-for="column in columns"
                  :key="column.key"
                  scope="col"
                  :class="[
                    column.key === 'actions'
                      ? 'relative py-3.5 pl-3 pr-4 sm:pr-6'
                      : 'px-3 py-3.5 text-left text-sm font-semibold text-gray-900',
                    column.key === 'image' && 'pl-4 pr-3 sm:pl-6',
                  ]"
                >
                  {{ column.key === "actions" ? "" : column.label }}
                  <span v-if="column.key === 'actions'" class="sr-only"
                    >Actions</span
                  >
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              <tr v-for="item in items" :key="item.id">
                <slot name="row" :item="item" :columns="columns" />
              </tr>
            </tbody>
          </table>
          <slot name="pagination" />
        </div>
      </div>
    </div>
  </div>
</template>

  <script setup>
defineProps({
  columns: {
    type: Array,
    required: true,
  },
  items: {
    type: Array,
    required: true,
  },
});
</script>
