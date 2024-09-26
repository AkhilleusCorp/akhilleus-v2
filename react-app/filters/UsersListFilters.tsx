import ListFilters from "./ListFilters.tsx";

interface UsersListFilters extends ListFilters {
    username: string | null;
    email: string | null;
    statuses: string[] | null;
    types: string[] | null;
}

export default UsersListFilters;