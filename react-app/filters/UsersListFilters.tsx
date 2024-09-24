type UsersListFilters = {
    ids: number[] | null;
    username: string | null;
    email: string | null;
    statuses: string[] | null;
    types: string[] | null;
    limit: number | null;
}

export default UsersListFilters;