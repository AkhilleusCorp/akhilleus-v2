import React, {useState} from "react";
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import useGetDropdownableEquipments from "../../hooks/equipment/useGetDropdownableEquipments.tsx";
import SelectInput from "../../components/input/SelectInput.tsx";
import useGetDropdownableMuscles from "../../hooks/muscle/useGetDropdownableMuscles.tsx";
import MultiSelectInput from "../../components/input/MultiSelectInput.tsx";
import movementRegistries from "../../constants/movementRegistries.tsx";

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

    const handleSelectChange = (event: SelectChangeEvent<string[]>|SelectChangeEvent) => {
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