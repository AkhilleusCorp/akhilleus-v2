import { useDispatch } from "react-redux";
import { bindActionCreators } from "redux";
import {actionCreators} from '../setup/redux';

const useActions = () => {
    const dispatch = useDispatch();

    return bindActionCreators(actionCreators, dispatch);
}

export default useActions;