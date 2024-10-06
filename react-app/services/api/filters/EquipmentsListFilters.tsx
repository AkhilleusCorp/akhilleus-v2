import ListFilters from "./ListFilters.tsx";

interface EquipmentListFilters extends ListFilters {
    name: string | null;
    status: string[];
}

export default EquipmentListFilters;