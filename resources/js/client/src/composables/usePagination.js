import { computed } from 'vue';

export function usePagination(store) {
    const paginationLinks = computed(() => {
        return (
            store.meta.links?.filter(
                (link) =>
                    !link.label.includes('Previous') &&
                    !link.label.includes('Next')
            ) ?? []
        );
    });

    const prevPage = () => {
        if (store.links.prev) {
            store.goToPage(store.meta.current_page - 1);
        }
    };

    const nextPage = () => {
        if (store.links.next) {
            store.goToPage(store.meta.current_page + 1);
        }
    };

    const goToPage = (page) => {
        if (!isNaN(page)) {
            store.goToPage(Number(page));
        }
    };

    return {
        paginationLinks,
        prevPage,
        nextPage,
        goToPage,
    };
}
