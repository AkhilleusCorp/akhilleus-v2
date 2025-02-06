import React, {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import AdminWorkoutsListFilters from "app/admin/services/api/filters/AdminWorkoutsListFilters.tsx";
import QueryIds from "app/common/utils/types/QueryIds.tsx";
import SearchForm from "app/common/components/form/SearchForm.tsx";
import MultiSelectInput from "app/common/components/input/MultiSelectInput.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";

type WorkoutSearchFormType = {
    defaultFilters: AdminWorkoutsListFilters,
    callbackFunction: (filters: AdminWorkoutsListFilters) => void;
}

const AdminWorkoutsSearchForm: React.FC<WorkoutSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<AdminWorkoutsListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>) => {
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
                <MultiSelectInput label={"Status"} name={"status"} value={filters.status}
                                  options={workoutRegistries.status}
                                  onSelectChange={handleSelectChange} required={false}/>
            </Grid>
        </SearchForm>
)
}

export default AdminWorkoutsSearchForm;