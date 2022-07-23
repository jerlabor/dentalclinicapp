import Model from './Model'

export default class Illness extends Model {
    // Set the resource route of the model
    resource() {
        return 'illnesses'
    }
}
