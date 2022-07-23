import Model from './Model'

export default class MaritalStatus extends Model {
    // Set the resource route of the model
    resource() {
        return 'marital_statuses'
    }
}
