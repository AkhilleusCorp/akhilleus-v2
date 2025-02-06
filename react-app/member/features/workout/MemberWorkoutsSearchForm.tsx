import React, {useState} from "react";
import {Grid2 as Grid, SelectChangeEvent} from "@mui/material";
import MemberWorkoutsListFilters from "app/member/services/api/filters/MemberWorkoutsListFilters.tsx";
import QueryIds from "app/common/utils/types/QueryIds.tsx";
import SearchForm from "app/common/components/form/SearchForm.tsx";
import MultiSelectInput from "app/common/components/input/MultiSelectInput.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";

type WorkoutSearchFormType = {
    defaultFilters: MemberWorkoutsListFilters,
    callbackFunction: (filters: MemberWorkoutsListFilters) => void;
}

const MemberWorkoutsSearchForm: React.FC<WorkoutSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<MemberWorkoutsListFilters>(defaultFilters);

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    return (
        <SearchForm searchFunction={callbackFunction} filters={filters}>
            <Grid size={{ xs: 4 }}>
                <MultiSelectInput label={"Status"} name={"status"} value={filters.status}
                                  options={workoutRegistries.status}
                                  onSelectChange={handleSelectChange} required={false}/>
            </Grid>
        </SearchForm>
    )
}

export default MemberWorkoutsSearchForm;