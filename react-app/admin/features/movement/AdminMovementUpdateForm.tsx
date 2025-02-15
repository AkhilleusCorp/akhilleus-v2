import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import {
    FormControl,
    FormControlLabel,
    FormGroup, FormLabel,
    Grid2 as Grid,
    SelectChangeEvent,
    Switch,
    TextField
} from "@mui/material";
import MovementUpdateSource from "app/admin/services/api/source/MovementUpdateSource.tsx";
import useGetDropdownableEquipments from "app/common/hooks/equipment/useGetDropdownableEquipments.tsx";
import useGetDropdownableMuscles from "app/common/hooks/muscle/useGetDropdownableMuscles.tsx";
import QueryIds from "app/common/utils/types/QueryIds.tsx";
import MovementApiGateway from "app/common/services/api/gateway/MovementApiGateway.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import movementRegistries from "app/common/constants/movementRegistries.tsx";
import MultiSelectInput from "app/common/components/input/MultiSelectInput.tsx";

type MovementUpdateFormType = {
    movement: MovementUpdateSource,
}

const AdminMovementUpdateForm: React.FC<MovementUpdateFormType> = ({movement}) => {
    const navigate = useNavigate();
    const [movementUpdated, setMovementUpdated] = useState<MovementUpdateSource>(movement);
    const equipments = useGetDropdownableEquipments();
    const muscles = useGetDropdownableMuscles();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>|SelectChangeEvent) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSwitchChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.checked
        });
    }

    const handleSubmit = async () => {
        try {
            await MovementApiGateway.updateMovement(movement.id, movementUpdated);
            navigate(adminRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                               name={"name"} value={movementUpdated.name} onChange={handleInputChange}/>
                </FormControl>

                <SelectInput label="Status" name={"status"} value={movementUpdated.status}
                             options={movementRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <SelectInput label="Primary muscle *" name={"primaryMuscle"} value={movementUpdated.primaryMuscle}
                             options={muscles} required={true} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"auxiliaryMuscles"} label={"Auxiliary muscles"}
                                  value={movementUpdated.auxiliaryMuscles} required={false} options={muscles} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"equipments"} label={"Equipment"}
                                  value={movementUpdated.equipments} required={false} options={equipments} onSelectChange={handleSelectChange}/>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <FormGroup>
                    <FormLabel>Configuration</FormLabel>
                    <FormControlLabel control={<Switch name={"hasReps"} checked={movementUpdated.hasReps} onChange={handleSwitchChange}/>} label="Reps" />
                    <FormControlLabel control={<Switch name={"hasWeight"} checked={movementUpdated.hasWeight} onChange={handleSwitchChange}/>} label="Weight" />
                    <FormControlLabel control={<Switch name={"hasDuration"} checked={movementUpdated.hasDuration} onChange={handleSwitchChange}/>} label="Duration" />
                    <FormControlLabel control={<Switch name={"hasDistance"} checked={movementUpdated.hasDistance} onChange={handleSwitchChange}/>} label="Distance" />
                    <FormControlLabel control={<Switch name={"hasSpeed"} checked={movementUpdated.hasSpeed} onChange={handleSwitchChange}/>} label="Speed" />
                </FormGroup>
            </Grid>
        </SaveForm>
    )
}

export default AdminMovementUpdateForm;