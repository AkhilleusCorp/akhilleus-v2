import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../services/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MultiSelectInput from "../../components/input/MultiSelectInput.tsx";
import useGetDropdownableEquipments from "../../hooks/equipment/useGetDropdownableEquipments.tsx";
import useGetDropdownableMuscles from "../../hooks/muscle/useGetDropdownableMuscles.tsx";
import SelectInput from "../../components/input/SelectInput.tsx";
import movementRegistries from "../../constants/movementRegistries.tsx";
import QueryIds from "../../utils/interfaces/QueryIds.tsx";

type MovementCreateFormType = {
    name: string;
}

const MovementCreateForm: React.FC = () => {
    const [movementCreate, setMovementCreate] = useState<MovementCreateFormType>({name: ''});
    const equipments = useGetDropdownableEquipments();
    const muscles = useGetDropdownableMuscles();

    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementCreate({
            ...movementCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>|SelectChangeEvent) => {
        setMovementCreate({
            ...movementCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            const movement = await MovementApiGateway.createMovement(movementCreate);
            navigate(websiteRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                               name={"name"} required={true} onChange={handleInputChange}/>
                </FormControl>
                <SelectInput label="Status" name={"status"} value={null}
                             options={movementRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <SelectInput label="Primary muscle" name={"primaryMuscle"} value={null}
                             options={muscles} required={true} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"auxiliaryMuscles"} label={"Auxiliary muscles"}
                                  value={[]} required={false} options={muscles} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"equipments"} label={"Equipment"}
                                  value={[]} required={false} options={equipments} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default MovementCreateForm;