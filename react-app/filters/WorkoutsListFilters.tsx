import ListFilters from "./ListFilters.tsx";

interface WorkoutsListFilters extends ListFilters {
    name: string | null;
    statuses: string[] | null;
}

export default WorkoutsListFilters;