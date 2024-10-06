import ListFilters from "./ListFilters.tsx";

interface MuscleListFilters extends ListFilters {
    name: string | null;
    status: string[];
}

export default MuscleListFilters;