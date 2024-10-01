import React, {useState} from "react";
import WorkoutsListFilters from "../../filters/WorkoutsListFilters.tsx";
import SearchForm from "../common/form/SearchForm.tsx";
import {TextField} from "@mui/material";

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

    const handleCancel = () => {
        setFilters(defaultFilters);
        console.log(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <SearchForm searchFunction={callbackFunction} cancelFunction={handleCancel} filters={filters}>
            <div className={"column"}>
                <div>
                    <TextField id="outlined-basic" label="IDs" variant="outlined" size="small"
                               name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange} />
                </div>
                <div>
                    <TextField id="outlined-basic" label="name" variant="outlined" size="small"
                               name={"name"} value={filters.name ?? ''} onChange={handleInputChange} />
                </div>
            </div>

            <div className={"column"}>
                <div>
                    <TextField id="outlined-basic" label="Status" variant="outlined" size="small"
                               name={"statuses"} value={filters.statuses ?? ''} onChange={handleInputChange} />
                </div>
            </div>
        </SearchForm>
)
}

export default WorkoutsSearchForm;