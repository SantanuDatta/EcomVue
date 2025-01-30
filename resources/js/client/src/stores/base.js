export const createBasePaginationState = () => ({
    meta: {
        current_page: 1,
        from: 1,
        last_page: 1,
        to: 1,
        total: 0,
        per_page: 10
    },
    links: {
        first: null,
        last: null,
        prev: null,
        next: null
    }
});
