import ListFilters from "./ListFilters.tsx";

interface WorkoutsListFilters extends ListFilters {
    name: string | null;
    status: string[] | null;
}

export default WorkoutsListFilters;