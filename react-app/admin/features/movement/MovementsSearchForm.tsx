import React, {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MovementsListFilters from "app/admin/services/api/filters/MovementsListFilters.tsx";
import useGetDropdownableEquipments from "app/admin/hooks/equipment/useGetDropdownableEquipments.tsx";
import useGetDropdownableMuscles from "app/admin/hooks/muscle/useGetDropdownableMuscles.tsx";
import QueryIds from "app/common/utils/interfaces/QueryIds.tsx";
import SearchForm from "app/common/components/form/SearchForm.tsx";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import MultiSelectInput from "app/common/components/input/MultiSelectInput.tsx";
import movementRegistries from "app/common/constants/movementRegistries.tsx";

type MovementSearchFormType = {
    defaultFilters: MovementsListFilters,
    callbackFunction: (filters: MovementsListFilters) => void;
}

const MovementsSearchForm: React.FC<MovementSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<MovementsListFilters>(defaultFilters);
    const equipments = useGetDropdownableEquipments();
    const muscles = useGetDropdownableMuscles();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>|SelectChangeEvent) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    return (
        <SearchForm searchFunction={callbackFunction} filters={filters}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="IDs" variant="outlined" size="small"
                               name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange}/>
                </FormControl>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="name" variant="outlined" size="small"
                               name={"name"} value={filters.name ?? ''} onChange={handleInputChange}/>
                </FormControl>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <SelectInput label="Muscle" name={"muscleId"} value={filters.muscleId ?? ''}
                                 options={muscles} required={false} onSelectChange={handleSelectChange}/>
                </FormControl>
                <FormControl fullWidth>
                    <SelectInput label="Equipment" name={"equipmentId"} value={filters.equipmentId ?? ''}
                                 options={equipments} required={false} onSelectChange={handleSelectChange}/>
                </FormControl>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <MultiSelectInput label={"Status"} name={"status"} value={filters.status}
                                  options={movementRegistries.status}
                                  onSelectChange={handleSelectChange} required={false}/>
            </Grid>
        </SearchForm>
)
}

export default MovementsSearchForm;