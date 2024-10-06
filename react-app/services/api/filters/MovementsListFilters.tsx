import ListFilters from "./ListFilters.tsx";

interface MovementsListFilters extends ListFilters {
    name: string | null;
    status: string[];
    muscleId: string | null;
    equipmentId: string | null;
}

export default MovementsListFilters;