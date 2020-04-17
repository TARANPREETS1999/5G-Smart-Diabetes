
import java.io.IOException;
import org.apache.hadoop.conf.Configuration;
import org.apache.hadoop.fs.Path;
import org.apache.hadoop.io.IntWritable;
import org.apache.hadoop.io.LongWritable;
import org.apache.hadoop.io.Text;
import org.apache.hadoop.mapreduce.Job;
import org.apache.hadoop.mapreduce.Mapper;
import org.apache.hadoop.mapreduce.Reducer;
import org.apache.hadoop.mapreduce.lib.input.FileInputFormat;
import org.apache.hadoop.mapreduce.lib.output.FileOutputFormat;
import org.apache.hadoop.mapreduce.lib.output.MultipleOutputs;
public class Moodfinder {
	
	public  static class Mymapper extends Mapper<LongWritable,Text,Text,Text>{
	
		@Override
		protected void map(LongWritable offset, Text line,Context context)
				throws IOException, InterruptedException {
			 String curr=line.toString();
			String text[]=curr.split(",");
			String emotions[]=text[6].split(";");
			double Emo[]={0,0,0,0,0,0,0};
			for(int i=0;i<6;i++)
			{
				Emo[i]=Double.parseDouble(emotions[i]);
			}
			
			  int max=find_emotion_index(Emo);

           String result=Emotion_in_words(max);
           context.write(new Text(result),new Text(text[5]+','+Double.toString(Emo[max])+','+Integer.toString(max)));
          
 }

		private String Emotion_in_words(int n) {
			// TODO Auto-generated method stub
					
			switch(n)
			{
			case 0:return "joy";
			case 1:return "love";
			case 2:return "suprise";
			case 3:return "anger";
			case 4:return "fear";
			case 5:return "sad";
			}
		
		return "nil";
		}

		private int find_emotion_index(double[] emo) {
int max=0;
for(int i=1;i<6;i++)
	if(emo[max]<emo[i])
		max=i;
	
			return max;
		}		
}

		
			 
			
		 
	public static class myReducer extends Reducer<Text,Text,Text,Text> {
      private MultipleOutputs<Text, Text> multipleOutputs;
      Context cont;
      String s[]={"Joy","Love","Suprise","Anger","Fear","Sad"};
      int counters[]={0,0,0,0,0,0};
      
		@Override
		protected void reduce(Text val, Iterable<Text> arr,Context cxt)
				throws IOException, InterruptedException {
			
			
			for( Text text:arr)
			{   String s=text.toString();
			    
			      
				String[] splitword=s.split(",");
				counters[Integer.parseInt(splitword[2])]++;
				multipleOutputs.write(new Text(splitword[0]),new Text(splitword[1]), generateFileName(val));
			}
		}
			String generateFileName(Text val){
			String word=val.toString();
			return word;
			}
			
			@Override
			public void setup(Context context){
				multipleOutputs = new MultipleOutputs<Text,Text>(context);
			}
			
			@Override
			public void cleanup(final Context context) throws IOException, InterruptedException{
				for(int i=0;i<6;i++)
				{
					multipleOutputs.write(new Text(s[i]),new Text(Integer.toString(counters[i])),"Total_Count");
				}
				
				multipleOutputs.close();
			}
	        }
		
		
		
		
		
	

	@SuppressWarnings("deprecation")
	public static void main(String[] args) throws IOException, ClassNotFoundException, InterruptedException{
        Configuration conf=new Configuration();
		Job job=new Job(conf,"Moodfinder");
		job.setJarByClass(Moodfinder.class);
		job.setMapperClass(Mymapper.class);
		job.setReducerClass(myReducer.class);
		job.setMapOutputKeyClass(Text.class);
		job.setMapOutputValueClass(Text.class);
		
		job.setOutputKeyClass(IntWritable.class);
	    job.setOutputValueClass(Text.class);
		 FileInputFormat.addInputPath(job,new Path(args[0]));
	     FileOutputFormat.setOutputPath(job,new Path(args[1]));
	     System.out.println("Running Sentiment Computing algorithm...\n");
	     System.exit ((job.waitForCompletion(true))? 0 : 1);	
}


}



