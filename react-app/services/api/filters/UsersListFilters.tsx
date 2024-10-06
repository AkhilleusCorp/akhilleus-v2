import ListFilters from "./ListFilters.tsx";

interface UsersListFilters extends ListFilters {
    username: string | null;
    email: string | null;
    status: string[] | null;
    type: string | null;
}

export default UsersListFilters;