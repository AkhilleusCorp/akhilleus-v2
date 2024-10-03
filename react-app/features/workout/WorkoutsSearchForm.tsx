import React, {useState} from "react";
import WorkoutsListFilters from "../../services/api/filters/WorkoutsListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {SelectChangeEvent, TextField} from "@mui/material";
import DropdownInput from "../../components/input/DropdownInput.tsx";
import workoutRegistries from "../../constants/workoutRegistries.tsx";

type WorkoutSearchFormType = {
    defaultFilters: WorkoutsListFilters,
    callbackFunction: (filters: WorkoutsListFilters) => void;
}

const WorkoutsSearchForm: React.FC<WorkoutSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<WorkoutsListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleCancel = () => {
        setFilters(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <SearchForm searchFunction={callbackFunction} cancelFunction={handleCancel} filters={filters}>
            <div>
                <TextField id="outlined-basic" label="IDs" variant="outlined" size="small"
                           name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange} />
            </div>
            <div>
                <TextField id="outlined-basic" label="name" variant="outlined" size="small"
                           name={"name"} value={filters.name ?? ''} onChange={handleInputChange} />
            </div>
            <div>
                <DropdownInput label={"Status"} name={"status"} value={filters.status} options={workoutRegistries.status}
                               onSelectChange={handleSelectChange} required={false} />
            </div>
        </SearchForm>
)
}

export default WorkoutsSearchForm;